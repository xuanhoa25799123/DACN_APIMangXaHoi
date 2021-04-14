@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/friend_list/style.css')}}">
    @endsection
@section('content')
        <p>Đã có {{$friends['summary']['total_count']}} người bạn vào ứng dụng</p>
        <div class="list-friends">
            @foreach($friends['data'] as $friend)
                <div class="friend-item">
                    <div class="item-header">
                    <img class="profile-img"src="{{$friend['picture']['data']['url']}}" href="">
                    <p>{{$friend['name']}}</p>
                    </div>
                    <div class="item-footer">
                        <a class="btn btn-primary" href="{{route('view.profile',['id'=>$friend['id']])}}">Xem thông tin</a>
                        <a class="btn btn-primary" href="{{route('social.add',['id'=>$friend['id']])}}">Gửi tin nhắn</a>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
