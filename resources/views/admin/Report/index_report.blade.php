@extends('layouts.admin')
<!-- ! Main -->
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
                            <a class="show-cat-btn" href="{{route('admin.dashboard')}}"><span class="icon home"
                                    aria-hidden="true"></span>Dashboard</a>
                        </li>
                        <li>
                            <a class="show-cat-btn" href="{{route('admin.index_user')}}">
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
                             
                    <li>
                            <a class="show-category-btn" href="##">
                                <span class="icon edit" aria-hidden="true"></span>Transaksi
                                <span class="category__btn transparent-btn" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu">
                                <li>
                                    <a href="{{route('admin.index_order')}}" >Pemesanan</a>
                                </li>
                                <li>
                                    <a href="{{route('admin.index_order_offline')}}">Penjualan</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="sidebar-body-menu">
                        <li>
                            <a  class="active" href="{{route('admin.generateReport')}}">
                                <span class="icon paper" aria-hidden="true"></span>Laporan
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>
 <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
  <div class="container main-nav">
    <div class="main-nav-start">
      <div class="search-wrapper">
        <form action="{{ route('admin.searchraport') }}" method="GET">
        <i data-feather="search" aria-hidden="true"></i>
        <input type="text"  name="search" placeholder="Enter keywords ..." required>
        
    <button type="submit" class="btn btn-create">Search</button></form>
      </div>
    </div>
    <div class="main-nav-end">
      <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
        <span class="sr-only">Toggle menu</span>
        <span class="icon menu-toggle--gray" aria-hidden="true"></span>
      </button>
      <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
        <span class="sr-only">Switch theme</span>
        <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
        <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
      </button>
     <!-- <div class="notification-wrapper">
        <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
          <span class="sr-only">To messages</span>
          <span class="icon notification active" aria-hidden="true"></span>
        </button>
        <ul class="users-item-dropdown notification-dropdown dropdown">
          <li>
            <a href="##">
              <div class="notification-dropdown-icon info">
                <i data-feather="check"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">System just updated</span>
                <span class="notification-dropdown__subtitle">The system has been successfully upgraded. Read more
                  here.</span>
              </div>
            </a>
          </li>
          <li>
            <a href="##">
              <div class="notification-dropdown-icon danger">
                <i data-feather="info" aria-hidden="true"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">The cache is full!</span>
                <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of memory space and
                  interfere ...</span>
              </div>
            </a>
          </li>
          <li>
            <a href="##">
              <div class="notification-dropdown-icon info">
                <i data-feather="check" aria-hidden="true"></i>
              </div>
              <div class="notification-dropdown-text">
                <span class="notification-dropdown__title">New Subscriber here!</span>
                <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
              </div>
            </a>
          </li>
          <li>
            <a class="link-to-page" href="##">Go to Notifications page</a>
          </li>
        </ul>
      </div>-->
      <div class="nav-user-wrapper">
        <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
          <span class="sr-only">My profile</span>
          <span class="nav-user-img">
            <picture><source srcset="{{asset('build/assets/img/avatar-illustrated-02.webp')}}" type="image/webp"><img src="{{asset('build/assets/img/avatar-illustrated-02.png')}}" alt="User name"></picture>
          </span>
        </button>
        <ul class="users-item-dropdown nav-user-dropdown dropdown">
          <li><a class="danger" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
              <i data-feather="log-out" aria-hidden="true"></i>
                    <span>{{ __('Logout') }}</span>
                <form action="{{ route('logout') }}" id="logout-form" method="post">
                @csrf                   
                </form>
            </a></li>
        </ul>
      </div>
    </div>
  </div>
</nav>
 
<main class="main users chart-page" id="skip-target">
    <div class="container">
        <h2 class="main-title">Data Laporan</h2>
        <div class="row">
            <div class="col-lg-9">
                <div class="col-lg-9">
                  <form  method="post" action="{{ route('admin.export') }}">
                    @csrf
                      <select name="month" id="month" class="form-control">
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                      </select>
                       <button class="btn-create"  id="export-pdf-btn" >Print
                    </button>
                    </form>
                </div>
                
                <div class="users-table table-wrapper">
                    <table class="posts-table">
                        <thead>
                            <tr class="users-table-info">
                                <th>No</th>
                                <th>Waktu</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Nomer HP</th>
                                <th>Order_id</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                             <!-- Inisialisasi counter -->
                            @php
                                $counter = 1;
                            @endphp
                            @foreach ($orders as $order)
                            <tr>
                              <td>{{ $counter }}</td>
                                <td>{{ $order->batas_waktu }}</td>
                                <td>{{ $order->user->username }}</td>
                                <td>{{ $order->alamat }}</td>
                                <td>{{ $order->phone }}</td>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->subtotal }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                              @php
                                $counter++;
                            @endphp
                            @endforeach
                             @foreach ($orderofflines as $orderoffline)
                          <tr>
                            <td>{{ $counter }}</td>
                              <td>{{ $orderoffline->batas_waktu }}</td>
                              <td>{{ $orderoffline->name }}</td>
                              <td>{{ $orderoffline->alamat }}</td>
                              <td>{{ $orderoffline->phone }}</td>
                              <td>{{ $orderoffline->id }}</td>
                              <td>{{ $orderoffline->subtotal }}</td>
                              <td>{{ $orderoffline->status }}</td>
                          </tr>
                            @php
                                $counter++;
                            @endphp
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>