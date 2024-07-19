<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StripeController extends Controller
{
    public function checkout($id)
    {
        $getProduct['getRecord'] = Product::findOrFail($id);    

        return view('payment.checkout', $getProduct);
    }

    public function session(Request $request, $id)
{
    \Stripe\Stripe::setApiKey(config('stripe.sk'));

    $product = Product::findOrFail($id);

    $productName = $request->input('product_name');
    $total = $request->input('total');
    $productId = $request->input('product_id');

    
    $buyerName = auth()->user()->name;

    $session = \Stripe\Checkout\Session::create([
        'payment_method_types' => ['card'],
        'line_items'  => [
            [
                'price_data' => [
                    'currency'     => 'USD',
                    'product_data' => [
                        "name" => $productName,
                    ],
                    'unit_amount'  => $total,
                ],
                'quantity'   => 1,
            ],
        ],
        'mode'        => 'payment',
        'success_url' => route('success', ['id' => $id, 'buyer_name' => $buyerName, 'product_id' => $productId]),
        'cancel_url'  => route('checkout', ['id' => $id]),
    ]);

    return redirect()->away($session->url);
}


public function success(Request $request, $id)
{
    $paymentStatus = 'Paid';
    $paymentMethod = 'Stripe';

    $buyerName = $request->query('buyer_name');
    $productId = $request->query('product_id');

    if (!$buyerName) {
        return redirect()->route('checkout', ['id' => $id])->withErrors('Buyer name is missing.');
    }

    $product = Product::findOrFail($productId);

    $orderDetail = OrderDetail::create([
        'buyer_name' => $buyerName,
        'order_date' => now()->format('Y-m-d'),
        'payment_status' => $paymentStatus,
        'payment_method' => $paymentMethod,
        'order_number' => strtoupper(uniqid('ORD-')),
    ]);

    $this->sendDiscordNotification($orderDetail, $product);

    return redirect('notifications');
}



    protected function sendDiscordNotification(OrderDetail $orderDetail, Product $product)
    {
        $webhookUrl = env('DISCORD_WEBHOOK_URL');
        
        if (!$webhookUrl) {
            throw new \Exception('Discord webhook URL is not set.');
        }

        $timestamp = now()->toIso8601String();
        $data = [
            'content' => "New Order Received!",
            'embeds' => [
                [
                    'title' => 'Order Details',
                    'description' => '',
                    'fields' => [
                        [
                            'name' => 'Buyer Name',
                            'value' => $orderDetail->buyer_name,
                            'inline' => true
                        ],
                        [
                            'name' => 'Order Date',
                            'value' => $orderDetail->order_date,
                            'inline' => true
                        ],
                        [
                            'name' => 'Payment Status',
                            'value' => $orderDetail->payment_status,
                            'inline' => true
                        ],
                        [
                            'name' => 'Payment Method',
                            'value' => $orderDetail->payment_method,
                            'inline' => true
                        ],
                        [
                            'name' => 'Order Number',
                            'value' => $orderDetail->order_number,
                            'inline' => true
                        ],
                        [
                            'name' => 'Item Purchased',
                            'value' => $product->product_name,
                            'inline' => true
                        ],
                        [
                            'name' => 'Item Price',
                            'value' => $product->price . ' USD',
                            'inline' => true
                        ],
                    ],
                    'timestamp' => $timestamp,
                ]
            ],
        ];

        Http::post($webhookUrl, $data);
    }
}