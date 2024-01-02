@extends('layouts.frontend')

@section('content')
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation -->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="{{ route('user_profile') }}">Profile</a>
        <!-- Add links to other profile sections here -->
    </nav>
    <hr class="mt-0 mb-4">
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
            <!-- Pending Orders section -->
            @foreach ($pendingOrders as $order)
            <div class="card mb-4">
                
                <div class="card-header">Order #{{ $order->id }}
                   
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        Alamat : {{$order->alamat}}<br>
                        RT/RW : {{$order->RTRW}}<br>
                        Post Kode : {{$order->postcode}}<br>
                        Nomer HP : {{$order->phone}}<br>
                        Total Harga: {{ $order->subtotal }}

                        @if ($order->status === 'Konfirmasi')
                            <div class="text-right">
                                <span class="badge badge-primary">Menunggu {{ $order->status}}</span></div>
                                    <div class="text-right"><p class="delete-item"><a href="{{route('delete_order_user',$order)}}"><i class="material-icons">close</i></a></p></div>
                                    @csrf
                                    @method('DELETE')
                       
                        @elseif ($order->status === 'Lunas')
                            <div class="text-right">
                                <span class="badge badge-success">{{ $order->status}}</span></div>

                          @elseif ($order->status === 'Validasi')
                          <br>
                            <span class="badge badge-warning">Produk ini harganya naik</span>
                            <div class="text-right">
                                    <form action="{{ route('respondToUser', $order) }}" method="POST">
                                        @csrf
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-sm btn-success mr-2" name="status" value="Belum Bayar">
                                                <i class="bi bi-check"></i> Terima
                                            </button>
                                            <button type="submit" class="btn btn-sm btn-danger" name="status" value="Ditolak">
                                                <i class="bi bi-x"></i> Tolak
                                            </button>
                                        </div>
                                    </form>
                                </div>
                        @else
                            @if($order->status === 'Ditolak')
                            <br>
                             <span class="badge badge-danger">Anda Menolak Pesanan</span>
                            
                            @else
                            @php
                                $now = time();
                                $deadline = strtotime($order->batas_waktu);
                                $timeLeft = $deadline - $now;
                            @endphp
                            @if ($timeLeft > 0)
                                <div style="width: 18rem;">
                                
                                    <a href="{{ route('checkout', $order->id) }}" class="btn btn-primary">Pay Now</a></div>
                                <div class="text-right">
                                    <p class=" mb-0">Waktu tersisa:  <span id="countdown-{{ $order->id }}"></span></p>
                                    <span class="badge badge-warning">Belum Bayar</span></div>
                                    <div class="text-right"><p class="delete-item"><a href="{{route('delete_order_user',$order)}}"><i class="material-icons">close</i></a></p></div>
                                    @csrf
                                    @method('DELETE')
                                <script>
                                    const deadline{{ $order->id }} = {{ strtotime($order->batas_waktu) }}

                                    function updateCountDown{{ $order->id }}(){
                                        const now = Math.floor(Date.now()/1000)
                                        const remainingTime = deadline{{ $order->id }} - now

                                        if(remainingTime > 0){
                                            const hours = Math.floor(remainingTime / 3600);
                                            const minutes = Math.floor((remainingTime % 3600) / 60)
                                            const seconds = remainingTime % 60

                                            document.getElementById("countdown-{{ $order->id }}").innerHTML = hours + " Jam " + minutes + " Menit " + seconds + " Detik "
                                        }else{
                                            document.getElementById("countdown-{{ $order->id }}").innerHTML = "Waktu Habis"
                                        }
                                    }

                                    window.setInterval(updateCountDown{{ $order->id }}, 1000);
                                </script>
                                @else
                                    <div class="text-right">
                                        <p class="mb-0">Waktu Habis</p>
                                        <span class="text-danger mb-0">{{ $order->status }}</span>
                                    </div>
                                    <style>
                                        .checkout-button-{{ $order->id }} {
                                            display: none;
                                        }
                                    </style>
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
            </div>
           
            @endforeach
        </div>
    </div>
</div>
@endsection
