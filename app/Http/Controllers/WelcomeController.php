<?php

namespace App\Http\Controllers;
use Request_search;
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

    public function shop_item($id)
    {
        $product = Product::findOrFail($id);
        return view('shop_item',[
            'product' => $product,
        ]);
    }

    public function search()
    {
        $query = Request_search::get ( 'query' );

        $products = Product::where('nome','ILIKE','%'.$query.'%')->orderBy('created_at', 'desc')->paginate(9);

        return view('welcome',[
            'products' => $products
            ]);
    }

    public function sortByPriceAscending(){

        $products = Product::orderBy('preco', 'asc')->paginate(9);

        return view('welcome',[
            'products' => $products
        ]);

    }

    public function sortByPriceDescending(){

        $products = Product::orderBy('preco', 'desc')->paginate(9);

        return view('welcome',[
            'products' => $products
        ]);

    }

    //funçao para mostrar os produtos por categoria
    public function products_category($category)
    {

        $products = Product::where('categoria',$category)->orderBy('created_at', 'desc')->paginate(9);

        return view('welcome_category',[
            'products' => $products
            ]);
    }

    public function sortByPriceAscendingCategory($category){

        $products = Product::where('categoria',$category)->orderBy('preco', 'asc')->paginate(9);

        return view('welcome_category',[
            'products' => $products
        ]);

    }

    public function sortByPriceDescendingCategory($category){

        $products = Product::where('categoria',$category)->orderBy('preco', 'desc')->paginate(9);

        return view('welcome_category',[
            'products' => $products
        ]);

    }
}
