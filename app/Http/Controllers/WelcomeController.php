<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
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
        $q = Input::get ( 'q' ); /////// INPUT NAO FUNCIONA NAO SEI PQ !!!!!!!!!!!!!!!! Q é o nome do input usado na view
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
