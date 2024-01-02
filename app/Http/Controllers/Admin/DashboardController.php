<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
         $totalUser = User::count();
         $totalproduct = Product::count();
         $totalOrder = Order::count();
        return view('admin.dashboard', [
            'totalUser' => $totalUser,
            'totalproduct' => $totalproduct,
            'totalOrder' => $totalOrder,
        ]);
    }

    
}
