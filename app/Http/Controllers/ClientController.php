<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Hash;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Session;
use PDF;
use Illuminate\Support\Facades\Mail;

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
        $user->last_name = $request->get('new_last_name');
        $user->address = $request->get('new_address');
        $user->post_number = $request->get('new_post_number');
        $user->phone_number = $request->get('new_phone_number');
        $user->city = $request->get('new_city');
        $user->country = $request->get('new_country');
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

    public function getCheckout(){
        $cart = Cart::getContent();
        return view('client.checkout',['products' => $cart]);
    }

    public function storeCheckout(Request $request){
        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::getSubTotal(),
                'currency' => 'CAD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
            ]);

            return redirect()->route('order.mail');

        }catch (Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }
    
    public function sendmail(Request $request){
        if (Cart::getTotalQuantity() > 0) {
            $carts = Cart::getContent();
            $data["email"]=Auth::user()->email;
            $data["client_name"]=Auth::user()->name;
            $data["subject"]="Payment receipt";

            $pdf = PDF::loadView('client.pdf_cart');

            try {
                Mail::send('client.pdf_cart', $data, function ($message) use ($data,$pdf) {
                    $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "cart.pdf");
                });
            } catch (JWTException $exception) {
                $this->serverstatuscode = "0";
                $this->serverstatusdes = $exception->getMessage();
            }
            if (Mail::failures()) {
                $this->statusdesc  =   "Error sending mail";
                $this->statuscode  =   "0";
            } else {
                $this->statusdesc  =   "Message sent Succesfully";
                $this->statuscode  =   "1";
            }
            foreach ($carts as $cart) {
                Cart::remove($cart->id);
            }
            $cart = Cart::getContent();
            return view('client.client_homepage', ['products' => $cart]);
        }
        $cart = Cart::getContent();
        return view('client.client_homepage', ['products' => $cart]);
    }

    public function show_orders(){
        return view('client.client_orders');
    }

    public function downloadPDFcart(){
        $pdf = PDF::loadView('client.pdf_cart');
        return $pdf->stream('cart.pdf');
    }
}
