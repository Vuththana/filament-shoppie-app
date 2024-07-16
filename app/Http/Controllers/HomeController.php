<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function card(Request $request,) {

        $categories = Category::all();

        $selectedCategory = $request->input('category_id');

        if($selectedCategory) {
            $products = Product::where('category_id', $selectedCategory)->get();
        } else {
            $products = Product::all();
        }
        
        $products->each(function ($product) {
            $product->revenue = $product->quantity_sold * $product->price;
            $product->stock_left = $product->stock - $product->quantity_sold;
        });

        return view('welcome', [
            'categories' => $categories,
            'products' => $products,
            'selectedCategory' => $selectedCategory,
        ]);
    }
}
