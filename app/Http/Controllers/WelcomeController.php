<?php

namespace App\Http\Controllers;
use Request;
use App\Product;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(9);

        return view('welcome',[
            'products' => $products,
        ]);
    }

    //funçao para mostrar os produtos por categoria
    public function products_category($category)
    {
        $products = Product::where('categoria',$category)->orderBy('created_at', 'desc')->paginate(9);

        return view('welcome',[
            'products' => $products
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
        $q = Request::get ( 'q' );
        $products = Product::where('nome','ILIKE','%'.$q.'%')->orderBy('created_at', 'desc')->paginate(9);

        return view('welcome',[
            'products' => $products
            ]);
    }
}
