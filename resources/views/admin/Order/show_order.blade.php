@extends('layouts.admin')

<div class="layer"></div>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-start">
                <div class="sidebar-head">
                    <a href="/" class="logo-wrapper" title="Home">
                        <span aria-hidden="true"><img src="{{asset('build/assets/img/Logo-2.png')}}" alt="" style="width: 135px;"></span>
                    </a>
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="sidebar-body">
                    <ul class="sidebar-body-menu">
                        <li>
                            <a class="" href="{{route('admin.dashboard')}}"><span class="icon home"
                                    aria-hidden="true"></span>Dashboard</a>
                        </li>
                        <li>
                            <a class="show-cat-btn" href="">
                                <span class="icon user-3" aria-hidden="true"></span>Pelanggan
                            </a>
                        </li>
                        <li>
                            <a class="show-category-btn" href="##">
                                <span class="icon folder" aria-hidden="true"></span>Kategori
                                <span class="category__btn transparent-btn" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu">
                                <li>
                                    <a href="{{route('admin.index_category_product')}}" >Kategor Barang</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.index_category_resep')}}">Kategor Resep</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="{{route('admin.index_product')}}">
                                <span class="icon dropbox" aria-hidden="true"></span>
                                Barang
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.index_resep')}}">
                                <span class="icon star" aria-hidden="true"></span>
                                Resep Masakan
                            </a>
                        </li>
                        <li>
                            <a href="{{route('admin.index_delivery')}}">
                                <span class="icon message" aria-hidden="true"></span>
                                Pengiriman
                            </a>
                        </li>
                    </ul>
                    <ul class="sidebar-body-menu">
                        <li>
                            <a href="{{route('admin.index_order')}}" class="active"><span class="icon edit" aria-hidden="true"></span>Pemesanan</a>
                        </li>
                        <li>
                            <a href="{{route('admin.generateReport')}}">
                                <span class="icon paper" aria-hidden="true"></span>Laporan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
<main class="main users chart-page" id="skip-target">           
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="col-lg-9">
                    <h1>{{$order->user->username}}</h1><br>
                    <p>{{$order->user->email}}</p><br>
                 </div>
                <div class="users-table table-wrapper">
                    <table class="posts-table">
                        <thead>
                            <tr class="users-table-info">
                                <th>Jumlah</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($order->transactions as $transaction)
                                <tr>
                                    
                                    <td>{{ $transaction->amount }}</td>
                                    <td><img src="{{url('storage/' . $transaction->product->image )}}" alt=""></td>
                                    <td>{{ $transaction->product->name }}</td>
                                    <td>{{ $transaction->amount * $transaction->product->price }}</td>
            
                                    <!-- ... Other transaction details ... -->
                                </tr>
                                @endforeach
                                @foreach ($order->transactionreseps as $transactionresep)
                                <tr>
                                    <td>{{ $transactionresep->amount }}</td>
                                    <td><img src="{{url('storage/' . $transactionresep->resep->image )}}" alt=""></td>
                                    <td>{{ $transactionresep->resep->name }}</td>
                                    <td>{{ $transactionresep->amount * $transactionresep->resep->price }}</td> <!-- Assuming you have a 'name' attribute in your Resep model -->
                                    <!-- ... Other transaction resep details ... -->
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>            
</main>
<script>
    
</script>