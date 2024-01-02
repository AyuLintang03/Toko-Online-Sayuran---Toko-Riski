<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet" />

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('build/assets/css/bootstrap.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/font-awesome.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/themify-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/elegant-icons.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/owl.carousel.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/nice-select.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/jquery-ui.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/slicknav.min.css')}}" type="text/css" />
    <link rel="stylesheet" href="{{asset('build/assets/css/style.css')}}" type="text/css" />

</head>
<body>
<div id="app">
    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i> hello.TokoRiski@gmail.com
                    </div>
                    
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </header>
    <!-- Header End -->
</div>

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
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>
