@extends('layouts.frontend')

@section('content')
<div class="col-lg-4">
    <div class="row">
        <div class="col-lg-12">
            <form action="{{ route('process_payment') }}" method="post" enctype="multipart/form-data">
                @csrf 

                <div class="proceed-checkout">
                    <h3>Alamat Pengiriman:</h3>
                    <p>Alamat: {{ $order->alamat }}</p>
                    <p>RTRW: {{ $order->RTRW }}</p>
                    <p>Postcode: {{ $order->postcode }}</p>
                    <p>Telepon: {{ $order->phone }}</p>

                    <h3>Daftar Barang:</h3>
                    @foreach ($cartproducts as $cartproduct)
                        <ul>
                            <li class="subtotal">Nama Bahan: <span>{{ $cartproduct->product->name }}</span></li>
                            <li class="subtotal mt-3"> Jumlah: <span>{{ $cartproduct->amount }}</span></li>
                            <li class="subtotal mt-3"> Harga: <span>{{ $cartproduct->product->price }}</span></li>
                        </ul>
                    @endforeach
                    <li class="subtotal mt-3">Total Biaya: <span>{{ $totalPrice }}</span></li>

                   
                    <button type="submit" class="proceed-btn">Bayar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
