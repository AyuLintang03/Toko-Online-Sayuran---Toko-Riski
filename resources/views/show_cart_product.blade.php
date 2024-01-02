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
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($cartproducts as $cartproduct)
                                        <tr>
                                            <td class="cart-pic first-row">
                                                <img src="{{url('storage/' . $cartproduct->product->image)}}" />
                                            </td>
                                            <td class="cart-title first-row text-center">
                                                <h5>{{$cartproduct->product->name}}</h5>
                                            </td>
                                            <td class="p-price first-row">Rp. {{$cartproduct->product->price}}</td>
                                            
                                            <form action="{{route('update_cart_product', $cartproduct)}}" method="post">
                                                <td class="cart-title first-row text-center">
                                                
                                                    @method('patch')
                                                    @csrf
                                                    <input type="number" name="amount" value="{{$cartproduct->amount}}">
                                            </form>
                                            </td>
                                            
                                             <form action="{{route('delete_cart_product', $cartproduct)}}" method="get">
                                                    @method('get')
                                                    @csrf
                                            <td class="delete-item"><a href="{{route('delete_cart_product', $cartproduct)}}"><i class="material-icons">
                                              close
                                              </i></a></td></form>
                                        </tr>
                                        
                                        @endforeach
                                    </tbody>
                                        <br>
                                        <tbody>
                                         @foreach ($cartreseps as $cartresep)
                                        <tr>
                                            <td class="cart-pic first-row">
                                                <img src="{{url('storage/' . $cartresep->resep->image)}}" />
                                            </td>
                                            <td class="cart-title first-row text-center">
                                                <h5>{{$cartresep->resep->name}}</h5>
                                            </td>
                                            <td class="p-price first-row">Rp. {{$cartresep->resep->price}}</td>
                                            
                                            <form action="{{route('update_cart_resep', $cartresep)}}" method="post">
                                                <td class="cart-title first-row text-center">
                                                
                                                    @method('patch')
                                                    @csrf
                                                    <input type="number" name="amount" value="{{$cartresep->amount}}">
                                            </form>
                                            </td>
                                            
                                             <form action="{{route('delete_cart_resep', $cartresep)}}" method="get">
                                                    @method('get')
                                                    @csrf
                                            <td class="delete-item"><a href="{{route('delete_cart_resep', $cartresep)}}"><i class="material-icons">
                                              close
                                              </i></a></td></form>
                                        </tr>  
                                         
                                                
                                        @endforeach
                                        </tbody>
                                </table>
                            </div>
                        </div>
                        @php
                        $isOutOfStock = false; // Initialize the variable
                        @endphp
                        @foreach ($cartproducts as $cartproduct)
                        @if ($cartproduct->product->stock <= 0)
                        @php
                            $isOutOfStock = true; // If any item is out of stock, set the variable to true
                            @endphp
                         <div class="alert alert-danger" role="alert">
                            <---------------------------------------------------Stok barang {{$cartproduct->product->name}} kosong-------------------------------------------------->
                        </div>
                        @endif
                        @endforeach
                        
                        @if(!$isOutOfStock && !$cartproducts->isEmpty() ||!$cartreseps->isEmpty())
                        <div class="col-lg-8">
                            <h4 class="mb-4">
                                Informasi Pembeli:
                            </h4>
                            <div class="user-checkout">
                                <form action="{{route('store_order')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group">
                                        <label for="alamat">Alamat Lengkap</label>
                                        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="RTRW">RT/RW</label>
                                        <input type="text" class="form-control" id="RTRW" name="RTRW" aria-describedby="noHPHelp" placeholder="Masukan RT/RW">
                                    </div>
                                    <div class="form-group">
                                        <label for="postcode">Kode Pos</label>
                                        <input type="text" class="form-control" id="postcode" name="postcode" aria-describedby="noHPHelp" placeholder="Masukan Kode Pos">
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Nomer Hp</label>
                                        <input type="text" class="form-control" id="phone" name="phone" aria-describedby="noHPHelp" placeholder="Masukan Nomer Hp">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="proceed-checkout">
                                <ul>
                                    
                                    <li class="subtotal mt-3">Nama Penerima <span>{{ Auth::user()->username }}</span></li>
                                    <li class="subtotal mt-3">Total Biaya <span>{{$totalPrice}}</span></li>
                                   
                                </ul>
                                    
                                <button type="submit" class="proceed-btn"  >CHECKOUT</button>
                            </div>
                        </div>
                    </div>
                </div></form>
                @endif
            </div>
        </div>
    </section>

<script>
document.addEventListener("DOMContentLoaded", function () {
   
    Swal.fire({
        title: 'Pemesanan akan dikirim H+1 (esok hari)',
        icon: 'info', 
        confirmButtonText: 'OK'
    });
});
</script>
@endsection

  