@extends('layouts.frontend')

@section('content')
<div class="container-xl px-4 mt-4">
    <!-- ... Navigation and Header ... -->
    <div class="row">
        <div class="col-xl-4">
            
            <!-- Profile picture card -->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Menu</div>
                <div class="card-body text-center">
                    <a href="{{ route('user_profile') }}"  class="list-group-item list-group-item-action">
                        <i class="bi bi-person"></i> Profile Saya
                    </a>
                    <a href="{{ route('order_user') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-cart"></i> Pesanan Saya
                    </a>
                    
                        <a href="{{ route('delivery')}}" class="list-group-item list-group-item-action">
                        <i class="bi bi-cart"></i> Pengiriman
                    </a>
                </div>
            </div>
        </div>
        
        <div class="col-xl-8">
            <!-- Loop through pending orders -->
            @foreach ($pendingOrders as $order)
                <div class="order">
                    <div class="text-right">
                         <p class="delete-item"><a href="{{route('delete_order_delivery',$order)}}"><i class="material-icons">
                            close</i></a></p></div>@csrf
                    @method('DELETE')
                    <h2>Order ID: {{ $order->id }}</h2>
                    <p>Status: {{ $order->status }}</p>
                    <p>Delivery Address: {{ $order->alamat }}</p>
                    <p>Subtotal: {{ $order->subtotal }}</p>
                    
                    @if ($order->status == 'Lunas')
                       @if ($order->delivery &&$order->delivery->delivery_status == 'Proses')
                           
                            <p>Pesanan sedang diproses</p>
                        @else
                             <form action="{{ route('markOrderReceived', ['order' => $order]) }}" method="get">
                            @csrf
                                <label for="recipient_name">Nama Penerima :</label>
                                    <input type="text" name="recipient_name" required>
                                    
                                    <button type="submit">Pesanan Diterima</button>
                                    </form>
                        @endif
                    @else
                        <p>Lakukan Pembayaran Dulu</p>
                    @endif
                </div>
                <hr>
            @endforeach
        </div>
    </div>
</div>
@endsection
