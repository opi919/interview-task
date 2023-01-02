<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Shipping;
use App\Models\Voucher;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (\Cart::isEmpty()) {
            return redirect('/')->with(['alert_type' => 'error', 'message' => 'Cart is empty']);
        } else {
            // add condition to cart
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Shipping Fee',
                'type' => 'shipping',
                'target' => 'total', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => '+100',
            ));
            \Cart::condition($condition);

            return view('checkout');
        }
    }

    public function addVoucher(Request $req)
    {

        $voucher = Voucher::where('code', $req->voucher)->first();
        if ($voucher) {
            // remove voucher
            \Cart::removeConditionsByType('voucher');
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => $voucher->code,
                'type' => 'voucher',
                'target' => 'subtotal', // this condition will be applied to cart's subtotal when getSubTotal() is called.
                'value' => '-' . $voucher->value,
            ));
            \Cart::condition($condition);
            return redirect()->back()->with(['alert_type' => 'success', 'message' => 'Voucher added successfully']);
        }
        return redirect()->back()->with(['alert_type' => 'error', 'message' => 'Voucher not found']);
    }

    public function store(Request $req)
    {

        $this->validate(
            $req,
            [
                'name' => 'required|string',
                'email' => 'required|email',
                'address' => 'required|string',
            ]
        );

        // dd($req->all());

        $ship = new Shipping();
        $ship->name = $req->name;
        $ship->email = $req->email;
        $ship->address = $req->address;
        $ship->save();

        $voucher = Voucher::where('code', $req->voucher)->first();
        $order = new Order();
        $order->shipping_id = $ship->id;
        $order->user_id = auth()->user()->id;
        $order->order_no = uniqid();
        $order->total = \Cart::getTotal();
        if ($req->voucher) {
            $order->voucher_id = $voucher->id;
        }

        $order->save();

        $items = \Cart::getContent();
        foreach ($items as $item) {
            $order->products()->attach($item['id'], ['quantity' => $item['quantity'], 'price' => $item['price']]);
        }

        \Cart::clearCartConditions();
        \Cart::clear();

        return redirect('/')->with(['alert_type' => 'success', 'message' => 'Order placed successfully']);
    }
}
