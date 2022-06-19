@extends('layouts.app')

@section('content')
    <div class="main-container container-fluid">
        <div class="page-header">
            <h1 class="page-title">User Chat</h1>
            <div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Message</li>
                    <li class="breadcrumb-item active" aria-current="page">chat</li>
                </ol>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="card">
            <div class="main-content-body main-content-body-chat h-100">
                <div class="main-chat-header pt-3 d-block d-sm-flex">
                    <div class="main-img-user online"><img alt="avatar" src="../assets/images/users/1.jpg"></div>
                    <div class="main-chat-msg-name mt-2">
                        <h6>{{ $user->username }}</h6>
                    </div>

                </div>
                <!-- main-chat-header -->
                <div class="main-chat-body flex-2">
                    <div class="mt-3">
                        @foreach ($message as $item)
                            <div
                                class="{{ $item->from == 'admin' ? 'media flex-row-reverse chat-right' : 'media chat-left' }}">
                                <div class="media-body">
                                    <div class="main-msg-wrapper">
                                        {{ $item->message }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ route('message-reply', $user->id) }}" method="post">
                        @csrf
                        <div class="main-chat-footer">
                            <input class="form-control" placeholder="Type your message here..." name="message"
                                type="text">

                            <button type="submit" class="btn btn-icon  btn-primary brround"><i
                                    class="fa fa-paper-plane-o"></i></button>
                            <nav class="nav">
                            </nav>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
