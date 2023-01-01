<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $req){
        $product = Product::find($req->product);

        $data['quantity'] = $req->quantity;
        $data['id'] = $product->id;
        $data['name'] = $product->name;
        $data['price'] = $product->price;
        $data['attributes'] = [$product->image];
        $data['assiociatedModel'] = $product;

        \Cart::add($data);

        // dd(\Cart::getContent());
        return redirect()->back(); 
    }

    public function delete($id){
        \Cart::remove($id);
        return redirect()->back();
    }
}
