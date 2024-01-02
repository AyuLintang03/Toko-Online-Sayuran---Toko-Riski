@extends('layouts.frontend')

@section('content')

<header class="header-section">
    <div class="container">
        <div class="inner-header">
            <div class="row">
                <div class="col-lg-2 col-md-2">
                    <div class="logo">
                        <a href="./index.html">
                            <img class="image" src="{{asset('build/assets/img/Toko Riski Logo.png')}}" alt="" />
                        </a>
                    </div>
                </div>
                    <div class="col-lg-7 col-md-7"></div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="cart-icon">
                                Keranjang
                                <a href="{{ route('show_cart_product') }}">
                                    <i class="icon_bag_alt"></i>
                                    <span>{{ $cartTotal }}</span>
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
    <!-- Header End -->

    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="{{asset('build/assets/img/Sayuran.jpg')}}">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5">
                            <span>Toko Riski</span>
                            <h1>Sayuran Segar</h1>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            </p>
                            <a href="#" class="primary-btn">Belanja Sekarang</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

         <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Update Harga Barang</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($products as $product)
                @if ($product->jenis === 'Naik')
                
                 <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{url('storage/' . $product->image)}}" alt="" />
                           
                            <form action="{{route('product_detail',$product)}}" methode="get">
                            <ul>
                                <li class="quick-view"><a href="{{route('product_detail',$product)}}">+ Detail</a></li>
                            </ul>
                        </form>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$product->category_product->name_category_products}}</div>
                            <a href="#">
                                <h5 class="product-name">{{$product->name}}</h5> 
                            </a>
                            <div class="product-price">
                               Rp. {{$product->price}}  <i class="fa fa-arrow-up" style="color: #ff0000;"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif ($product->jenis === 'Turun')
                  <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{url('storage/' . $product->image)}}" alt="" />
                            <form action="{{route('product_detail',$product)}}" methode="get">
                            <ul>
                                <li class="quick-view"><a href="{{route('product_detail',$product)}}">+ Detail</a></li>
                            </ul>
                        </form>
                        </div>
                        <div class="pi-text">
                            
                            <div class="catagory-name">{{$product->category_product->name_category_products}}</div>
                            <a href="#">
                                <h5 class="product-name">{{$product->name}}</h5>
                            </a>
                            <div class="product-price">
                               Rp. {{$product->price}} <i class="fa fa-arrow-down" style="color: #A8DF8E;"></i>
                            </div>
                        </div>
                    </div>
                </div>
               
                @endif
                @endforeach
            </div>
        </div>
    </div>
    
    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-5">
                            <div class="section-title">
                                <h2>Kategori Barang</h2>
                            </div>
                         
                    <div class="product-slider owl-carousel">
                        @foreach ($categoryproducts as $categoryproduct)
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{url('storage/' . $categoryproduct->image_category_products)}}" alt="" />
                                <ul>
                                    <li class="quick-view"><a href="{{route('product_list',$categoryproduct)}}">Lihat</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <a href="">
                                    <h4>{{$categoryproduct->name_category_products}}</h4>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
      
    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mt-5">
                            <div class="section-title">
                                <h2>Kategori Resep Makanan</h2>
                            </div>
                         
                    <div class="product-slider owl-carousel">
                        @foreach ($creseps as $cresep)
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="{{url('storage/' . $cresep->image_category_resep)}}" alt="" />
                                <ul>
                                     <li class="quick-view"><a href="{{route('resep_list',$cresep)}}">Lihat</a></li>
                                </ul>
                            </div>
                            <div class="pi-text">
                                <a href="">
                                   <h4>{{$cresep->name_category_resep}}</h4>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

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
  

@endsection
