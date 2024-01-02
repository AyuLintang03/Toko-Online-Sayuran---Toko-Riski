<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
class DeleteController extends Controller
{
    
    public function destroy(Order $order)
    {
        $order->delete();
        
        return Redirect::route('index_order');
    }

    public function destroy_delivery(Delivery $delivery)
    {
        $delivery->delete();
        
        return Redirect::route('admin.index_delivery');
    }

    public function destroy_laporan(Order $order)
    {
        $order->delete();
        
        return Redirect::route('index_report');
    }
        public function searchdelivery(Request $request)
{
        $search = $request->input('search');
        $deliverys = Delivery::where(function ($query) use ($search) {
        $query->where('order_id', 'like', '%' . $search . '%')
              ->orWhere('delivery_status', 'like', '%' . $search . '%'); 
        })->paginate();

    return view('Admin.Delivery.index_delivery', ['deliverys' => $deliverys]);
}


  

}
