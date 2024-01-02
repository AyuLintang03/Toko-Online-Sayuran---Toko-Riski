<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CategoryProduct;
use App\Models\CategoryResep;
use App\Models\CartProduct;
use App\Models\CartResep;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
  //  public function __construct()
    //{
        
      //  $this->middleware(['auth','verified']);
    //}

 
    public function index()
    {
        $products=Product::all();
         $creseps = CategoryResep::all();
         $categoryproducts = CategoryProduct::all();
         $user_id = Auth::id();
        $cartTotal = CartProduct::where('user_id', $user_id)->count('product_id')
            + CartResep::where('user_id', $user_id)->count('resep_id');
        return view('frontend.homepage', compact('categoryproducts','creseps','cartTotal','products'));
    }
}

