<!DOCTYPE html>
<html lang="zxx">
  <head>
    <meta charset="UTF-8" />
    <meta name="description" content="Ogani Template" />
    <meta name="keywords" content="Ogani, unica, creative, html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{csrf_token()}}" />
    <title>Toko Riski</title>
    
       <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('build/assets/css/bootstrap.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/themify-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/elegant-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/owl.carousel.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/nice-select.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/jquery-ui.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/slicknav.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/style.css')}}" type="text/css" />
    
    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css" />
  </head>

  <body>
    <!-- Page Preloder -->
    <div id="preloder">
      <div class="loader"></div>
    </div>

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
      <div class="humberger__menu__logo">
        <a href="#"><img src="{{ asset('frontend/img/logo.png') }}" alt="" /></a>
      </div>
      <div class="humberger__menu__cart">
        <ul>
          <li>
            <a href="#"><i class="fa fa-heart"></i> <span>1</span></a>
          </li>
          <li>
            <a href="#"><i class="fa fa-shopping-bag"></i> <span></span></a>
          </li>
        </ul>
        <div class="header__cart__price">item: <span></span></div>
      </div>
      <div class="humberger__menu__widget">
          @guest
            <div class="header__top__right__language">
              <div class="header__top__right__auth">
                <a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a>
              </div>
            </div>
            <div class="header__top__right__auth" style="margin-left: 20px">
              <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
            </div>
          @else 
          <div class="header__top__right__language">
            <div class="header__top__right__auth">
              <a href="{{ route('user_profile')}}"><i class="fa fa-user"></i> {{ auth()->user()->username }}</a>
            </div>
            <span class="arrow_carrot-down"></span>
            <ul>
              <li><a href="#">Profile</a></li>
            </ul>
          </div>
          <div class="header__top__right__auth" style="margin-left: 20px">
            <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><i class="fa fa-user"></i> Logout</a>
            <form action="{{ route('logout') }}" id="logout-form" method="post">
              @csrf 

            </form>
          </div>
          @endguest
      </div>
      <nav class="humberger__menu__nav mobile-menu">
        <ul>
          <li class="active"><a href="/">Home</a></li>
          <li><a href="">Shop</a></li>
          <li>
            <a href="#">Categories</a>
            <ul class="header__menu__dropdown">
            
                <li><a href=""></a></li>
            </ul>
          </li>
          <li><a href="#">Contact</a></li>
        </ul>
      </nav>
      <div id="mobile-menu-wrap"></div>
      <div class="header__top__right__social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-linkedin"></i></a>
        <a href="#"><i class="fa fa-pinterest-p"></i></a>
      </div>
      <div class="humberger__menu__contact">
        <ul>
          <li><i class="fa fa-envelope"></i> tokoriski02@gmail.com</li>
        
        </ul>
      </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
      <div class="header__top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="header__top__left">
                <ul>
                  <li><i class="fa fa-envelope"></i> tokoriski02@gmail.com</li>
                </ul>
              </div>
            </div>
            <div class="col-lg-6 col-md-6">
                @guest
                  <div class="header__top__right">
                    <div
                      class="header__top__right__language header__top__right__auth"
                    >
                      <a class="d-inline" href="{{ route('login') }}"
                        ><i class="fa fa-user"></i> Login</a
                      >
                    </div>
                    <div class="header__top__right__auth">
                      <a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a>
                    </div>
                </div>
                @else 
                <div class="header__top__right">
                <div
                  class="header__top__right__language header__top__right__auth"
                >
                  <a class="d-inline" 
                    ><i class="fa fa-user"></i> {{ auth()->user()->username }}</a
                  >
                  <span class="arrow_carrot-down"></span>
                  <ul>
                    <li><a href="{{ route('user_profile')}}">Profile</a></li>
                  </ul>
                </div>
                <div class="header__top__right__auth">
                  <a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit()"><i class="fa fa-user"></i> Logout</a>
                  <form action="{{ route('logout') }}" id="logout-form" method="post">
                    @csrf                   
                  </form>
                </div>
              </div>
                @endguest
            </div>
          </div>
        </div>
      </div>
      
    </header>
    <!-- Header Section End -->

    @yield('content')


    <!-- Js Plugins -->
    <script src="{{asset('build/assets/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('build/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('build/assets/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('build/assets/js/jquery.countdown.min.js')}}"></script>
    <script src="{{asset('build/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('build/assets/js/jquery.zoom.min.js')}}"></script>
    <script src="{{asset('build/assets/js/jquery.dd.min.js')}}"></script>
    <script src="{{asset('build/assets/js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('build/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{asset('build/assets/js/main.js')}}"></script>
    <script src="{{asset('build/assets/js/script.js')}}"></script>
    <script src="{{asset('build/assets/js/feather.min.js')}}"></script>
    <script src="{{asset('build/assets/js/chart.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</div>
  </body>
</html>