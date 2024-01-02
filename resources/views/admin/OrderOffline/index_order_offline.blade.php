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
                            <a class="show-category-btn active" href="##">
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
                            <a class="show-cat-btn" href="{{route('admin.generateReport')}}">
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
        <form action="{{ route('admin.searchOrder') }}" method="GET">
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
        <h2 class="main-title">Penjualan</h2>
        <div class="row">
            <div class="col-lg-9">
              
              <div class="col-lg-9">
                 <button class="btn-create">
                  <a href="{{route('admin.create_order_offline')}}">Tambah</a></button>
                 </div>
                <div class="users-table table-wrapper">
                    <table class="posts-table">
                        <thead>
                            <tr class="users-table-info">
                                <th>No</th>
                                <th>waktu</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>Kode Post</th>
                                <th>RT/RW</th>
                                <th>Phone</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($orderofflines as $orderoffline)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$orderoffline->batas_waktu}}</td>
                                <td>{{$orderoffline->name}}</td>
                               <td>{{$orderoffline->alamat}}</td>
                               <td>{{$orderoffline->postcode}}</td>
                               <td>{{$orderoffline->RTRW}}</td>
                               <td>{{$orderoffline->phone}}</td>
                               <td>{{$orderoffline->subtotal}}</td>
                               @if ($orderoffline->status === 'Lunas')
                                  <td><span class="badge badge-success">{{$orderoffline->status}}</span></td>
                                @elseif ($orderoffline->status === 'Hutang')
                                  <td><span class="badge badge-pending">{{$orderoffline->status}}</span></td>
                                @elseif ($orderoffline->status === 'Belum Bayar')
                                  <td><span class="badge badge-disabled">{{$orderoffline->status}}</span></td>
                               @else
                                  <td><span class="badge badge-trashed ">{{$orderoffline->status}}</span></td>
                               @endif
                                <td>            
                                  <span class="p-relative">       
                                            <ul   class="icon-container">     
                                                <li><a href="{{ route('admin.show_order_offline', $orderoffline) }}"
                                                onclick="showOverlay('orderDetailsOverlay');"
                                                class="transaction-detail-link"
                                                data-order-id="{{ $orderoffline->id }}"
                                                data-order-user="{{ $orderoffline->name }}" title="Detail"><i class="fa fa-info-circle" style="color: #0066eef; font-size: 24px; cursor:pointer;cursor:pointer; "></i></a></li>
                                                 <li><a href="{{route('admin.edit_order_offline',$orderoffline)}}" ><i class="fa fa-pencil" style="color: #004dd1; font-size: 24px; cursor:pointer;cursor:pointer; " title="Edit"></i></a></li>
                                              
                                            </ul>         
                                    </span>
                                </td>
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