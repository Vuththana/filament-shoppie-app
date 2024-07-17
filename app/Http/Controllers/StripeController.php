<?php 
 
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
 
class StripeController extends Controller
{
    public function checkout($id)
    {
        $data['getRecord'] = Product::getSingle($id);
        if(!empty($data['getRecord']))
        {
            return view('payment.checkout', $data);
        }
        else
        {
            abort(404);
        }
    }

 
    public function session(Request $request, $id)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));
        
        $product = Product::findOrFail($id);
        
        $productName = $request->input('product_name');
        $total = $request->input('total');

        $session = \Stripe\Checkout\Session::create([
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