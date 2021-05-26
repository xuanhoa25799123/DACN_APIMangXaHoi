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
@endsection
