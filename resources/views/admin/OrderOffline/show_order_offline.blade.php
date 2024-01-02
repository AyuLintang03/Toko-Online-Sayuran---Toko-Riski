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
                    <h1>{{$orderoffline->name}}</h1><br>
                    <p>{{$orderoffline->alamat}}</p><br>
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
                             @foreach ($orderoffline->transaksiorderofflines as $transaksiorderoffline)
                                <tr>
                                    
                                    <td>{{ $transaksiorderoffline->amount }}</td>
                                    <td><img src="{{url('storage/' . $transaksiorderoffline->product->image )}}" alt=""></td>
                                    <td>{{ $transaksiorderoffline->product->name }}</td>
                                    <td>{{ $transaksiorderoffline->amount * $transaksiorderoffline->product->price }}</td>
            
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