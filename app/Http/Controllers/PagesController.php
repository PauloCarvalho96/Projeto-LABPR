<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
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

    public function index()
    {
        $orders['orders'] = DB::table('orders')->get();


        return view('product.orders', [
            'orders' => $orders['orders'],
        ]);
    }

}
