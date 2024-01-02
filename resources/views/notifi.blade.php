@extends('layouts.app')

@section('content')
    <h1>Notifications</h1>

    @foreach ($notifications as $notification)
        <div class="notification">
            <p>{{ $notification->message }}</p>
        </div>
    @endforeach
@endsection
