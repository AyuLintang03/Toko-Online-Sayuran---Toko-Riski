@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2>Chat with Admin</h2>
                <div class="chat-box">
                    <div class="message-list">
                        @foreach ($messages as $message)
                            <div class="message">
                                <strong>{{ $message->sender->username }}:</strong>
                                {{ $message->content }}
                            </div>
                        @endforeach
                    </div>
                    <form action="{{ route('chat.send') }}" method="post">
                        @csrf
                        <textarea name="content" class="form-control" placeholder="Type your message"></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Send</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
