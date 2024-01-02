<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\CartResep;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\TransactionResep;
use App\Models\Product;
use App\Models\Delivery;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

use App\Models\OrderOffline;
use App\Notifications\NewOrderNotification;

use Carbon\Carbon;

class OrderController extends Controller
{
     
     public function store_order(Request $request)
    {
        $user = Auth::user();
        $user_id = Auth::id();
        $cartproducts = CartProduct::where('user_id', $user_id)->get();
        $cartreseps = CartResep::where('user_id', $user_id)->get();
         $pendingOrders = Order::where('user_id', $user->id)
        ->whereIn('status', ['Lunas', 'Belum Bayar','Konfirmasi','Validasi','Ditolak','Diterima'])
        ->where(function ($query) {
            $query->whereNull('batas_waktu')
                ->orWhere('batas_waktu', '>', now());
        })
        ->get();


        if ($cartproducts->isEmpty() && $cartreseps->isEmpty()) {
            return Redirect::back();
        }

        $request->validate([
            'alamat' => 'required',
            'RTRW' => 'required',
            'postcode' => 'required',
            'phone' => 'required',
        ]);
        $totalCartProductPrice = $cartproducts->sum(function ($cartproduct) {
            return $cartproduct->amount * $cartproduct->product->price;
        });

        $totalCartResepPrice = $cartreseps->sum(function ($cartresep) {
            return $cartresep->amount * $cartresep->resep->price;
        });

        $totalPrice = ($totalCartProductPrice + $totalCartResepPrice);
        
        //$batasWaktu = Carbon::now()->addDay()->startOfDay();
        $batasWaktu = Carbon::now()->addDay();
        $order = Order::create([
            'user_id' => $user_id,
            'alamat' => $request->alamat,
            'RTRW' => $request->RTRW,
            'postcode' => $request->postcode,
            'phone' => $request->phone,
            'status'=> 'Konfirmasi',
            'subtotal' => $totalPrice,
            'batas_waktu' => $batasWaktu ,
        ]);

       if (!$cartproducts->isEmpty() && $order->status === 'Lunas') {
        $cartproducts->each(function ($cartproduct) {
            $cartproduct->delete();
        });
    }

    if (!$cartreseps->isEmpty() && $order->status === 'Lunas') {
        $cartreseps->each(function ($cartresep) {
            $cartresep->delete();
        });
    }
        //Notification::create([
          //  'order_id' => $order->id,
            //'user_id' => Auth::id(),
            //'message' => 'A new order has been placed.',
        //]);

        if (!$cartproducts->isEmpty()) {
            foreach ($cartproducts as $cartproduct) {
                Transaction::create([
                    'amount' => $cartproduct->amount,
                    'order_id' => $order->id,
                    'product_id' => $cartproduct->product_id,
                ]);
                
            }
            
                //$cartproduct->delete();  
        }

        if (!$cartreseps->isEmpty()) {
            foreach ($cartreseps as $cartresep) {
                TransactionResep::create([
                    'amount' => $cartresep->amount,
                    'order_id' => $order->id,
                    'resep_id' => $cartresep->resep_id,
                ]);
                
            }
        }
        

        return view('order_user', compact('cartproducts', 'cartreseps',  'totalPrice','order','pendingOrders'));
    }

    public function index_order()
{
    $orders = Order::all();
    return view('Admin.Order.index_order', compact('orders'));
}
        public function show_order(Order $order)
        {
            $order->load(['transactions', 'transactionreseps']);

            return view('Admin.Order.show_order', compact('order'));
        }

        public function delete_order_user(Order $order)
    {
        $order->delete();
        
        return Redirect::route('order_user');}


        public function redirectToCheckout(Order $order)
    {
        $user_id = Auth::id();
        $cartproducts = CartProduct::where('user_id', $user_id)->get();
        $cartreseps = CartResep::where('user_id', $user_id)->get();
        

        if (!$cartproducts->isEmpty()) {
            foreach ($cartproducts as $cartproduct) {
                Transaction::create([
                    'amount' => $cartproduct->amount,
                    'order_id' => $order->id,
                    'product_id' => $cartproduct->product_id,
                ]);
              
            }
            // $cartproduct->delete(); 
        }

        if (!$cartreseps->isEmpty()) {
            foreach ($cartreseps as $cartresep) {
                TransactionResep::create([
                    'amount' => $cartresep->amount,
                    'order_id' => $order->id,
                    'resep_id' => $cartresep->resep_id,
                ]);
               
            }
                //$cartresep->delete(); 
        }
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;
        $params = array(
            'transaction_details' => array(
                'order_id' => $order->id,
                'gross_amount' => $order->subtotal,
            ),
            'customer_details' => array(
                'username' => Auth::user()->username,
                'email' => Auth::user()->email,
                'phone' =>   $order->phone,
            ),
            
        );
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('checkout', compact('cartproducts', 'cartreseps','order','snapToken'));
    }

    public function callback (Request $request){
        $serverKey=config('midtrans.server_key');
        $hashed = hash("sha512",$request->order_id.$request->status_code.$request->gross_amount.$serverKey);
        if($hashed == $request->signature_key){
            if ($request->transaction_status=='capture') {
                $order = Order::find($request->order_id);
                $order->update(['status'=>'Lunas']);
            }
            elseif ($request->transaction_status=='pending') {
                $order = Order::find($request->order_id);
                $order->update(['status'=>'Lunas']);
            }
        }
    }

     public function order_user()
{
    $user = Auth::user();
    $pendingOrders = Order::where('user_id', $user->id)
        ->whereIn('status', ['Lunas', 'Belum Bayar','Konfirmasi','Ditolak','Diterima','Validasi'])
        ->where(function ($query) {
            $query->whereNull('batas_waktu')
                ->orWhere('batas_waktu', '>', now());
        })
        ->get();

    //$nextDayDeadline = now()->addDay()->endOfDay();
    $nextDayDeadline = now()->addDay();
    foreach ($pendingOrders as $order) {
        $batasWaktu = Carbon::parse($order->batas_waktu);
        if ($batasWaktu->isPast() || $batasWaktu > $nextDayDeadline) {
            Transaction::where('order_id', $order->id)->delete();
            TransactionResep::where('order_id', $order->id)->delete();

            $order->delete();
        }
    }

    return view('order_user', compact('pendingOrders'));
}

   public function respondToUser(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:Belum Bayar,Ditolak',
    ]);

    $order->update(['status' => $request->status]);
     return Redirect::route('order_user', $order);
}


public function index_delivery(){
    $deliverys = Delivery::all();
        return view('Admin.Delivery.index_delivery', compact('deliverys'));
}

public function delivery()
    {
        $user = Auth::user();
        $pendingOrders = Order::where('user_id', $user->id)
            ->whereIn('status', ['Lunas', 'Belum Bayar'])
            ->get();

        return view('delivery', compact('pendingOrders'));
    }

 

public function markOrderReceived(Order $order, Request $request)
{
    $order->update(['delivery_status' => 'Pesanan Diterima']);

    $delivery = Delivery::where('order_id', $order->id)->first();

    if ($delivery) {
        $delivery->update([
            'delivery_status' => 'Pesanan Diterima', 
        ]);
    }

    return redirect()->route('delivery');
}
// app/Http/Controllers/OrderController.php

//public function storeDelivery(Request $request)
//{
  //  $request->validate([
    //    'order_id' => 'required|exists:orders,id',
       // 'recipient_name' => 'required',
      //  'delivery_status' => 'required|in:Pesanan Belum Diterima,Pesanan Diterima, Proses',
       
    //]);

   
 //   $order = Order::findOrFail($request->order_id);

    // Create a new delivery record
   // $delivery = new Delivery([
     //   'order_id' => $order->id,
       // 'recipient_name' => $request->recipient_name,
        //'delivery_address' => $order->alamat,
        //'delivery_status' => $request->delivery_status,
    //]);
    //$delivery->save();

  //  return redirect()->route('admin.index_delivery')
    //    ->with('success', 'Delivery record created successfully.');
//}

public function createdelivery()
{
     $orders = Order::all();
    $deliverys=Delivery::all();
    
    return view('Admin.Delivery.create_delivery',compact('orders','deliverys'));
}

public function storeDelivery(Request $request){
     $request->validate([
            'order_id' => 'required|exists:orders,id',
            //'recipient_name' => 'required',
           'delivery_status' => 'required|in:Pesanan Belum Diterima,Proses,Pesanan Sedang Diantar,Pesanan Diterima,Dibatalkan',
        ]);
         $order = Order::findOrFail($request->order_id);

        Delivery::create([
            'order_id' => $order->id,
          //  'recipient_name' => $request->recipient_name,
            'delivery_address' => $order->alamat,
            'delivery_status' => $request->delivery_status,

        ]);
        return Redirect::route('admin.index_delivery');
}

    public function delete_order_delivery(Order $order)
    {
        $order->delete();
        
        return Redirect::route('delivery');}

    
public function searchOrder(Request $request)
{
        $search = $request->input('search');
       $orders = Order::join('users', 'orders.user_id', '=', 'users.id')
        ->where(function ($query) use ($search) {
            $query->where('orders.alamat', 'like', '%' . $search . '%')
                ->orWhere('orders.postcode', 'like', '%' . $search . '%') 
                ->orWhere('users.username', 'like', '%' . $search . '%')
                ->orWhere('orders.status', 'like', '%' . $search . '%'); 
        })
        ->paginate();

        
    return view('admin.Order.index_order', ['orders' => $orders]);
}

public function generateReport()
{
    $orders = Order::with(['user', 'transactions', 'transactionreseps', 'delivery'])->get();
    $orderofflines = OrderOffline::all();
    // Return the Blade view with the data
    return view('Admin.Report.index_report', compact('orders','orderofflines'));
}
 public function edit_order(Order $order)
    {
       
        return view('Admin.Order.edit_order', compact('order'));}

public function update_order_status(Request $request, Order $order)
{
    $request->validate([
        'status' => 'required|in:Belum Bayar,Lunas,Ditolak,Diterima,Validasi',
    ]);

    $order->update(['status' => $request->status]);

    return Redirect::route('admin.index_order', $order);
}

 public function editdelivery(Delivery $delivery)
    {
        
        return view('admin.Delivery.edit_delivery', compact('delivery'));
    }

public function update_delivery(Request $request, Delivery $delivery)
{
    $request->validate([
        'delivery_status' => 'required|in:Pesanan Belum Diterima,Pesanan Diterima,Proses,Pesanan Sedang Diantar',
        
    ]);

    $delivery->update([ 
        'delivery_status' => $request->delivery_status,
    ]);

   return Redirect::route('admin.index_delivery', $delivery);
}


}

