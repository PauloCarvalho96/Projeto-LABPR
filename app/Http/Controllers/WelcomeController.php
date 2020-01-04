<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
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

    public function search()
    {
        $q = Input::get ( 'q' );
        if($q != ""){
            $product = Product::where ( 'name', 'LIKE', '%' . $q . '%' )->get ();
            if (count ( $product ) > 0)
                return view ( 'welcome' )->withDetails ( $product )->withQuery ( $q );
            else
                return view ( 'welcome' )->withMessage ( 'No Details found. Try to search again !' );
        }
        return view('/product/search')->withMessage ( 'No Details found. Try to search again !' );
    }
}