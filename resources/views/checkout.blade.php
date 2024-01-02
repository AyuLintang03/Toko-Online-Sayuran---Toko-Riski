@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('homepage')}}" class="home"><i class="fa fa-home"></i> Home</a>
                        <span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->
  <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cart-table">
                                <table>
                                    <thead> 
                                        <tr>
                                            <th>Gambar</th>
                                            <th class="p-name text-center">Nama Produk</th>
                                            <th>Harga</th>
                                            <th>Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         @foreach ($cartproducts as $cartproduct)
                                            <tr>
                                                <td class="cart-pic first-row"><img src="{{url('storage/' . $cartproduct->product->image)}}" alt="Product Image"></td>
                                                <td class="p-name text-center">{{ $cartproduct->product->name }}</td>
                                                <td class="p-price first-row">{{ $cartproduct->product->price }}</td>
                                                <td class="p-price first-row">{{ $cartproduct->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody>
                                         @foreach ($cartreseps as $cartresep)
                                            <tr>
                                                <td class="cart-pic first-row"><img src="{{url('storage/' . $cartresep->resep->image)}}" alt="Product Image"></td>
                                                <td class="p-name text-center">{{ $cartresep->resep->name }}</td>
                                                <td class="p-price first-row">{{ $cartresep->resep->price }}</td>
                                                <td class="p-price first-row">{{ $cartresep->amount }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="proceed-checkout">
                                <ul>
                                   <li class="subtotal">ID Transaction <span>#{{ $order->id }}</span></li>
                                    <li class="subtotal mt-3">Nama Pelanggan <span>{{ Auth::user()->username }}</span></li>
                                    <li class="subtotal">Alamat <span>{{ $order->alamat }}</span></li>
                                    <li class="subtotal">RT/RW <span>{{ $order->RTRW }}</span></li>
                                    <li class="subtotal">Kode Post <span>{{ $order->postcode }}</span></li>
                                    <li class="subtotal">Nomer HP  <span>{{ $order->phone }}</span></li>
                                    <li class="subtotal mt-3">Total Biaya <span>{{$order->subtotal}}</span></li>
                                </ul>
                                    
                                <button type="submit" class="proceed-btn" id="pay-button"> Bayar Sekarng</button>
                            </div>
                        </div>
                    </div>
                </div></form>
            </div>
        </div>
    </section>
 <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="{{config('midtrans.client_key')}}"></script>
    <script type="text/javascript">
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
        // Trigger snap popup
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                alert("Payment success!"); console.log(result);
                 window.location.href = '{{ route("order_user") }}';
            },
            onPending: function(result){
                alert("Waiting for your payment!"); console.log(result);
            },
            onError: function(result){
                alert("Payment failed!"); console.log(result);
            },
            onClose: function(){
                alert('You closed the popup without finishing the payment');
                 window.location.href = '{{ route("order_user") }}';
            }
        });
    });
</script>
@endsection
