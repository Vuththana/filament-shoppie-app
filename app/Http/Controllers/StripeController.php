<?php 
 
namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function checkout( $id)
    {
        $getProduct['getRecord'] = Product::getSingle($id);
        
        return view('payment.checkout', $getProduct);
    }

 
    public function session(Request $request, $id)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        
        $product = Product::findOrFail($id);
        
        $productName = $request->input('product_name');
        $total = $request->input('total');

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
            'success_url' => route('success'),
            'cancel_url'  => route('checkout', ['id' => $id]),
        ]);
 
        return redirect()->away($session->url);
    }
 
    public function success()
    {
        return redirect('notifications');
    }
}