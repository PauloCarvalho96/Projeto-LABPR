<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Request_search;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);

        return view('product.index', [
            'products' => $products,
        ]);
    }

    public function orders()
    {
        $orders['orders'] = DB::table('orders')->get();

        return view('product.orders', [
            'orders' => $orders['orders'],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create a Product
        $product = new Product;

        if($request->hasFile('imagem')){
            $file = $request->file('imagem');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('img/products'),$filename);
            $product->imagem = $filename;
        }

        $product->nome = $request->nome;
        $product->categoria = $request->categoria;
        $product->descricao = $request->descricao;
        $product->preco = $request->preco;
        $product->save(); // save it to the database.
        //Redirect to a specified route
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);

        return view('product.show', [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Find a Product by it's ID
        $product = Product::findOrFail($id);
        return view('product.edit', [
            'product' => $product,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if($request->hasFile('imagem')){
            $file = $request->file('imagem');
            $extension = $file->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $file->move(public_path('img/products'),$filename);
            $product->imagem = $filename;
        }

        if($request->has('categoria')){
            $product->categoria = $request->categoria;
        }

        $product->nome = $request->nome;
        $product->descricao = $request->descricao;
        $product->preco = $request->preco;
        $product->save(); //Can be used for both creating and updating
        return redirect()->route('products.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Delete a product
        $product = Product::findOrFail($id);

        if($product->imagem){
            $filename = $product->imagem;
            $path = public_path('img/products/').$filename;
            unlink($path);  //elimina ficheiro
        }

        $product->delete();

        //Redirect to a specified route
        return redirect()->route('products.index');
    }

    public function show_pdf_order($filename){
        return response()->file(storage_path('app/public/pdf/'.$filename));
    }
    public function showUsers(){
        $users = DB::table('users')->where('is_admin','=',false)->orderBy('created_at', 'desc')->paginate(5);
        return view('product.show_users',['users' => $users]);
    }
    
    public function removeUser($id){
        DB::table('users')->where('id', '=',$id)->delete();
        return redirect()->back();
    }

    public function search_products()
    {
        $query = Request_search::get ( 'query' );

        $products = Product::where('nome','ILIKE','%'.$query.'%')->orderBy('created_at', 'desc')->paginate(9);

        return view('product.index',[
            'products' => $products
            ]);
    }

    public function search_orders()
    {
        $query = Request_search::get ( 'query' );

        $orders = DB::table('orders')->where('user_email','ILIKE','%'.$query.'%')->orderBy('created_at', 'desc')->paginate(9);

        return view('product.orders',[
            'orders' => $orders
            ]);
    }

    public function search_users()
    {
        $query = Request_search::get ( 'query' );

        $users = DB::table('users')->where([['email','ILIKE','%'.$query.'%'],['is_admin','=',false]])->orderBy('created_at', 'desc')->paginate(9);

        return view('product.show_users',[
            'users' => $users
            ]);
    }
}
