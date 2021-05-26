@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/follower-chat.css')}}">
    <link rel="stylesheet" href="{{asset('/css/paginate.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.css')}}"> -->
@endsection
@section('js')
    <script src="{{asset('/js/follower.js')}}"></script>
          <!-- <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.js')}}"> -->
@endsection
@section('content')
    <div class="chat-container">
    <div class="recent-message">
        @foreach($recentMessages as $message)
        <div class="recent-item">
            <div class="user-info">
            <div class="user-avatar">
                <img class="user-image" src="{{$message->to_avatar}}" href="">
            </div>
            <div class="message-info">
                <p class="username">{{$message->to_display_name}}</p>
                <p class="message">{{$message->message}}</p>

            </div>
            </div>
            <p class="time">{{$message->time}}</p>
        </div>
        @endforeach
    </div>
    <div class="user-message">
        <div class="user-message-header">
            <div class="user-info">
            <div class="user-avatar">
                <img class="user-image" src="{{$userMessages[0]->to_avatar}}">

            </div>
            
            <p class="username2">{{$userMessages[0]->to_display_name}}</p>
            </div>
            </div>
            <div class="message-container">
            
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Nhập nội dung tin nhắn...">
            </div>
        
    </div>
    </div>
@endsection
