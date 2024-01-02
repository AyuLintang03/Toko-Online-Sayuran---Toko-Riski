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
                                Keranjang&nbsp;
                                <a href="#">
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
    <!-- Header End -->
    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>{{$category->name_category_resep}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            
            @foreach($reseps as $resep)
                <div class="col-lg-3 col-sm-6">
                    <div class="product-item">
                        <div class="pi-pic">
                            <img src="{{url('storage/' . $resep->image)}}" alt="" />
                            <form action="{{route('resep_detail',$resep)}}" methode="get">
                            <ul>
                                <li class="quick-view"><a href="{{route('resep_detail',$resep)}}">+ Detail</a></li>
                            </ul>
                        </form>
                        </div>
                        <div class="pi-text">
                            <div class="catagory-name">{{$resep->category_resep->name_category_resep}}</div>
                            <a href="#">
                                <h5 class="product-name">{{$resep->name}}</h5>
                            </a>
                            <div class="product-price">
                               Rp. {{$resep->price}}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
               
            </div>
        </div>
    </div>
    <!-- Related Products Section End -->


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