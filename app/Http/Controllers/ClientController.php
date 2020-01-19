<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use Hash;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Exception;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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

    public function changeClient(){
        return view('auth.changeClient');
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

    public function deleteUser(Request $request){
        if (!(Hash::check($request->get('password_delete'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if (!(Hash::check($request->get('password_confirm_de'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        DB::table('users')->where('id', '=',Auth::user()->id )->delete();
        return redirect()->route('welcome');
    }
    public function getCart(){
        $cart = Cart::getContent();
        return view('client.client_homepage', ['products' => $cart]);
    }

    public function addCart($id){
        $product = Product::findOrFail($id);
        Cart :: add($id,$product->nome,$product->preco,1);

        return redirect()->back();
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
        $carts['cart'] = Cart::getContent();
        if((Cart::getTotalQuantity() )== 0){
            return redirect()->route('welcome');
        }

        return view('client.checkout',['products' => $carts['cart']]);
    }

    public function storeCheckout(Request $request){
        try {
            $charge = Stripe::charges()->create([
                'amount' => Cart::getSubTotal(),
                'currency' => 'EUR',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
            ]);
            $data = array('address' => $request->address,'city'=>$request->city,'postalcode'=>$request->postalcode);
            $this->sendmail($data);

            $cart = Cart::getContent();
            return view('client.client_homepage', ['products' => $cart]);

        }catch (Exception $e) {
            return back()->withErrors('Error! ' . $e->getMessage());
        }
    }

    public function sendmail($dados){

        if (Cart::getTotalQuantity() > 0) {
            $carts = Cart::getContent();
            $data["email"]=Auth::user()->email;
            $data["client_name"]=Auth::user()->name;
            $data["subject"]="Payment receipt";

            $pdf = PDF::loadView('client.pdf_cart',compact('dados'));

            # guarda pdf no servidor #

            #vai ficar dentro da pasta storage/app/public/pdf
            $pdf_name = time();
            Storage::put('public/pdf/'.$pdf_name.'.pdf',$pdf->output());

            # Insere na tabela das orders #
            $user_email = Auth::user()->email;
            $filename = $pdf_name.'.pdf';
            $total_price = Cart::getSubTotal();

            DB::table('orders')->insert([
                'user_email' => $user_email,
                'pdf' => $filename,
                'valor_total' => $total_price,
                ]);

            try {
                Mail::send('product.mail_pdf', $data, function ($message) use ($data,$pdf) {
                    $message->to($data["email"], $data["client_name"]);
                    $message->subject($data["subject"]);
                    $message->attachData($pdf->stream(), 'client.pdf');
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
        }
        $cart = Cart::getContent();
        return view('client.client_homepage', ['products' => $cart]);
    }

    public function show_orders(){

        $user_email = Auth::user()->email;    # id do utilizador

        $orders['orders'] = DB::table('orders')->where('user_email','=',$user_email)->get();  #encomendas com o seu id

        return view('client.client_orders', [
            'orders' => $orders['orders'],
        ]);
    }

    public function show_pdf_order($filename){

        return response()->file(storage_path('app/public/pdf/'.$filename));

    }
}
