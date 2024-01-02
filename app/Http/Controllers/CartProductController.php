<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartProduct;
use App\Models\Resep;
use App\Models\CartResep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_to_cart_product(Product $product, Request $request)
    {
        $user_id = Auth::id();
        $product_id = $product->id;

        $existing_cart = CartProduct::where('product_id',$product_id)
        ->where('user_id', $user_id)
        ->first();

        if($existing_cart == null)
        {
                
            $request->validate([
                'amount'=> 'required|gte:1|lte:' . $product->stock
            ]);

            CartProduct::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'amount' => $request->amount
            ]);
        }

        else {

             $request->validate([
                'amount'=> 'required|gte:1|lte:' . ($product->stock-$existing_cart->amount)
            ]);

            $existing_cart->update([
                'amount'=>$existing_cart->amount +$request->amount
            ]);
            
        }


         return Redirect::route('show_cart_product');
    }
    public function add_to_cart_resep(Resep $resep, Request $request)
    {
        $user_id = Auth::id();
        $resep_id = $resep->id;

        $existing_cart = CartResep::where('resep_id',$resep_id)
        ->where('user_id', $user_id)
        ->first();

        if($existing_cart == null)
        {
            CartResep::create([
                'user_id' => $user_id,
                'resep_id' => $resep_id,
                'amount' => $request->amount
            ]);
        }

        else {

             $request->validate([
                'amount'=> 'required|gte:1|lte:' . ($existing_cart->amount)
            ]);

            $existing_cart->update([
                'amount'=>$existing_cart->amount +$request->amount
            ]);
            
        }
         return Redirect::route('show_cart_product');
    }


    public function show_cart_product()
    {
    $user_id = Auth::id();
    $cartreseps = CartResep::where('user_id', $user_id)->get();
    $cartproducts = CartProduct::where('user_id', $user_id)->get();

    $totalPrice = 0;

    foreach ($cartproducts as $cartproduct) {
        $totalPrice += $cartproduct->product->price * $cartproduct->amount;
    }

    foreach ($cartreseps as $cartresep) {
        $totalPrice += $cartresep->resep->price * $cartresep->amount;
    }

    return view('show_cart_product', compact('cartproducts', 'cartreseps', 'totalPrice'));
     
    }

    public function update_cart_product(CartProduct $cartproduct, Request $request)
    {
        $request->validate([
            'amount'=> 'required|gte:1|lte:' . $cartproduct->product->stock
        ]);

        $cartproduct->update([
            'amount' => $request->amount
        ]);

         return Redirect::route('show_cart_product');
    }

    public function delete_cart_product(CartProduct $cartproduct)
    {
        $cartproduct->delete();   


         return Redirect::back();
    }

    public function delete_cart_resep(CartResep $cartresep)
    {
        $cartresep->delete();
        
         return Redirect::back();
    }

    public function update_cart_resep(CartResep $cartresep, Request $request)
{

    $cartresep->update([
        'amount' => $request->amount
    ]);

    return Redirect::route('show_cart_product');
}
}
