<?php

namespace App\Http\Controllers;
use App\Models\Resep;
use App\Models\Order;
use App\Models\TransaksiOrderOffline;
use App\Models\OrderOffline;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Midtrans\Snap;
use Midtrans\Config;
use App\Notifications\NewOrderNotification;

use Carbon\Carbon;
use Illuminate\Http\Request;

class OrderOfflineController extends Controller
{
    public function create_order_offline()
    {
        
        
       $products = Product::all(); 
    $productOptions = [];
    foreach ($products as $product) {
        $productNameWithSatuan = $product->name . ' (' . $product->satuan . ')';
        $productOptions[$product->id] = $productNameWithSatuan;
    }
        $reseps = Resep::pluck('name','id');
        return view('admin.OrderOffline.create_order_offline',compact('reseps','productOptions'));
    }

public function store_order_offline(Request $request)
{
    $request->validate([
        'name' => 'required',
        'alamat' => 'required',
        'RTRW'=>'required',
        'postcode' => 'required',
         'phone' => 'required',
        'status' => 'required',
        'batas_waktu' => 'required',
        //'subtotal' => 'required',
     //  'jenis' => 'required|array',
        'product_amount' => 'required|array',
        'product_id' => 'required|array',
    ]);

//    $file = $request->file('image');
  //  $path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
    //Storage::disk('local')->put('public/' . $path, file_get_contents($file));

    $orderoffline = OrderOffline::create([
        'name' => $request->name,
        'alamat' => $request->alamat,
        'RTRW' => $request->RTRW,
        'postcode' => $request->postcode,
        'phone' => $request->phone,
        'status' => $request->status,
        'batas_waktu' => $request->batas_waktu,
        //'subtotal' => $request->subtotal,
    ]);

   $totalProductPrice = 0;

    foreach ($request->product_id as $key => $product_id) {
        $product = Product::find($product_id);
        $totalProductPrice += $product->price * $request->product_amount[$key];
        
     
        TransaksiOrderOffline::create([
            'amount' => $request->product_amount[$key],
   //         'jenis' => $request->jenis[$key],
            //'resep_id' => $resep->id,
            'product_id' => $product_id,
            'order_offline_id' => $orderoffline -> id,
        ]);
    }

    $orderoffline->update([
        'subtotal' => $totalProductPrice,
    ]);

    return Redirect::route('admin.index_order_offline');
}
public function index_order_offline()
    {
        $orderofflines = OrderOffline::all();
        return view('admin.OrderOffline.index_order_offline', compact('orderofflines'));
    }

    public function edit_order_offline(OrderOffline $orderoffline)
    {
          $products = Product::all(); 
        $productOptions = [];
    foreach ($products as $product) {
        $productNameWithSatuan = $product->name . ' (' . $product->satuan . ')';
        $productOptions[$product->id] = $productNameWithSatuan;
    }
        $transaksiorderofflines = TransaksiOrderOffline::where('order_offline_id', $orderoffline->id)->get();
        
    return view('admin.OrderOffline.edit_order_offline', compact( 'orderoffline','productOptions', 'transaksiorderofflines'));;}
     
    

    public function update_order_offline(Resep $resep,Request $request)
    {
      $request->validate([
         'name' => 'required',
        'alamat' => 'required',
        'RTRW'=>'required',
        'postcode' => 'required',
         'phone' => 'required',
        'status' => 'required',
        'batas_waktu' => 'required',
        //'subtotal' => 'required',
     //  'jenis' => 'required|array',
        'product_amount' => 'required|array',
        'product_id' => 'required|array',
    ]);

   // $file = $request->file('image');
    //$path = time() . '_' . $request->name . '.' . $file->getClientOriginalExtension();
    //Storage::disk('local')->put('public/' . $path, file_get_contents($file));

    // Perbarui data resep
    $orderofflines->update([
        'name' => $request->name,
        'alamat' => $request->alamat,
        'RTRW' => $request->RTRW,
        'postcode' => $request->postcode,
        'phone' => $request->phone,
        'status' => $request->status,
        'batas_waktu' => $request->batas_waktu,
        //'subtotal' => $request->subtotal,
    ]);

    $totalProductPrice = 0;

    foreach ($request->product_id as $key => $product_id) {
        $product = Product::find($product_id);
        $totalProductPrice += $product->price * $request->product_amount[$key];

        $transaksiorderofflines = TransaksiOrderOffline::where('order_offline_id', $orderoffline->id)
            ->where('product_id', $product_id)
            ->first();

        if ($transaksiorderofflines) {
            $transaksiorderofflines->update([
                'amount' => $request->product_amount[$key],
            ]);
        }
    }

    $resep->update([
        'subtotal' => $totalProductPrice,
    ]);

    return Redirect::route('admin.index_order_offline', $orderofflines);
    }
    

    public function searchresep(Request $request)
{
    $search = $request->input('search');
    $orderofflines =OrderOffline::where('name', 'like', '%' . $search . '%')->paginate();

    
		return view('admin.OrderOffline.index_order_offline',['orderofflines' => $orderofflines]);
}
  public function show_order_offline(OrderOffline $orderoffline)
        {
            $orderoffline->load(['transaksiorderofflines']);

            return view('admin.OrderOffline.show_order_Offline', compact('orderoffline'));
        }

}
