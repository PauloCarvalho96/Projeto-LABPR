<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Hash;
use Session;

class ClientController extends Controller
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

    public function home_client()
    {
        return view("client.client_homepage");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function showChangePasswordForm(){
        return view('auth.changepassword');
    }

    //muda a password do utilizador
    public function changePassword(Request $request){
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    //muda os dados do utilizador
    public function changeDataUser(Request $request){
        //verifica se a pass corresponde
        if (!(Hash::check($request->get('password_check'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        $validatedData = $request->validate([
            'new_name' => ['required', 'string', 'max:255'],
        ]);
        $user = Auth::user();
        $user->name = $request->get('new_name');
        $user->save();
        return redirect()->back()->with("success","Data changed successfully !");
    }

    public function getCart(){
        $cart = Cart::getContent();
        return view('client.client_homepage', ['products' => $cart]);
    }

    public function addCart($id){
        $product = Product::findOrFail($id);
        Cart :: add($id,$product->nome,$product->preco,1);
        $cart = Cart::getcontent();
        $user = Auth::user();

       # Cart::store($user); #ESTÁ A DAR ERRO NAO SEI PQ !!!!
        return view('client.client_homepage',[ 'products' => $cart ]);
    }

    public function deleteCart($id){
        Cart::remove($id);
        $cart = Cart::getContent();
        return view('client.client_homepage',['products' => $cart]);
    }

    public function lessItem($id){
        Cart::update($id,['quantity'=>-1]);
        $cart = Cart::getContent();
        return view('client.client_homepage',['products' => $cart]);
    }
}
