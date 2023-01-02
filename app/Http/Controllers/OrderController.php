<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user();
        $data['orders'] = $user->orders()->orderBy('created_at', 'desc')->get();
        // get orders products
        foreach ($data['orders'] as $order) {
            $order->products = $order->products()->get();
        }
        return view('order',$data);
    }
}
