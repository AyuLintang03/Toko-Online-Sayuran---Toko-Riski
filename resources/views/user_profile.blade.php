@extends('layouts.frontend')

@section('content')
<!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{route('homepage')}}" class="home"><i class="fa fa-home"></i> Home</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container-xl px-4 mt-4">
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">{{ Auth::user()->username }}</div>
                <div class="card-body text-center">
                    <img class="img-account-profile rounded-circle mb-2" src="{{ Auth::user()->image ? url('storage/' . Auth::user()->image) : asset('build/assets/img/Login.png') }}"  alt="Profile Picture">
                </div>
                <div class="card-body text-center">
                    <a href="{{ route('user_profile') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-person"></i> Profile Saya
                    </a>
                    <a href="{{ route('order_user') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-cart"></i> Pesanan Saya
                    </a>
                    <a href="{{ route('delivery') }}" class="list-group-item list-group-item-action">
                        <i class="bi bi-cart"></i> Pengiriman
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="post" action="{{ route('update_profile', ['user' => Auth::user()]) }}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">Username</label>
                            <input class="form-control" id="inputUsername" name="username" value="{{ Auth::user()->username }}" type="text" placeholder="Enter your username">
                            <label class="small mb-1" for="inputEmail">Email</label>
                            <input class="form-control" id="inputEmail" type="text" name="email" value="{{ Auth::user()->email }}"  placeholder="Enter your Email">
                            <label class="small mb-1" for="inputImage">Profile Image</label>
                            <input class="form-control" id="inputImage" type="file" name="image">
                        </div>
                        <button class="btn btn-primary" type="submit">Save changes</button> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
