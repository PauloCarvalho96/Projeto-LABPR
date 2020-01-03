<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class WelcomeController extends Controller
{

    public function welcome()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);

        return view('welcome',[
            'products' => $products,
        ]);
    }

    public function shop_item($id)
    {
        $product = Product::findOrFail($id);
        return view('shop_item',[
            'product' => $product,
        ]);
    }
}