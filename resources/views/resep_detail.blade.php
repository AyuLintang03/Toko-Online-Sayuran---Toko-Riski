@extends('layouts.frontend')

@section('content')
<header class="header-section">
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="{{route('homepage')}}">
                            <img src="{{asset('build/assets/img/Toko Riski Logo.png')}}" alt="" />
                        </a>
                    </div>
                </div>
                    <div class="col-lg-7 col-md-7"></div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="cart-icon">
                                Keranjang &nbsp;
                                <a href="{{ route('show_cart_product') }}">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{$cartTotal}}</span>
                                </a>
                            </li>
                            <li>
                                <nav class="main-nav--bg">
                                        <div class="container main-nav">
                                            <div class="main-nav-end">
                                                <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                                                    <span class="sr-only">Switch theme</span>
                                                    <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                                                    <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </nav>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </header>
   
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('homepage')}}" class="home"><i class="fa fa-home"></i> Home</a>
                        <span>Detail</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="{{url('storage/' . $resep->image)}}" alt="" />
                            </div>
                        </div>
                    
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <span>{{$resep->category_resep->name_category_resep}}</span>
                                    <h3>{{$resep->name}}</h3><br>
                                </div>
                                <h5>Bahan</h5>
                                @foreach($resepProducts as $resepProduct)
                                    <h6>{{ $resepProduct->product->name }} : {{ $resepProduct->amount }} {{$resepProduct->jenis}}</h6>
                                @endforeach
                                <br>
                                <div class="pd-desc">
                                <p>
                                  {{$resep->description}}   
                                </p>
                                
                                    <h4 class="product-price">Rp. {{$resep->price}}</h4><br>
                                    <form action="{{route('add_to_cart_resep', $resep->id)}}" method="post">
                                    @csrf
                                    <input type="number" name='amount' class="form-control" style="margin-left: -30px;" id="amountInput">
                                
                                </div>
                                 <div class="quantity">
                                    <button type="submit" class="primary-btn pd-cart" onclick="showSweetAlertWithDelay()" >Tambahkan Keranjang</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

   


    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="{{asset('build/assets/img/Logo-2.png')}}" alt="" /></a>
                        </div>
                        <ul>
                            <li>Alamat: Jl. Dahlia VII No.42, Labuhan Ratu, Kec. Kedaton, Kota Bandar Lampung, Lampung 35142</li>
                            <li>Nomer Hp: +628 22081996</li>
                            <li>Email: TokoRiski @gmail.com</li>
                        </ul>
                    </div>
                </div>
               <div class="col-lg-3 offset-lg-1">
                   <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">Tentang Kami</a></li>
                            <li><a href="#">Checkout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Order</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            All rights reserved | TokoRiski
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
  
 <script>
    // Function to show SweetAlert after a delay
    function showSweetAlertWithDelay() {
        setTimeout(function() {
            Swal.fire({
                title: 'Berhasil Ditambahkan ke Keranjang',
                icon: 'success',
                timer: 1000, // Show for 2 seconds
                timerProgressBar: true,
                showConfirmButton: false
            });
        }, 1000); // Delay in milliseconds
    }
</script>  

 @endsection
 

