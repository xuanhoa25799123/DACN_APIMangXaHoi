@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/friend_list/style.css')}}">
    @endsection
@section('content')
        <p>Bạn bè đã vào ứng dụng</p>
        <div class="list-friends">
            @foreach($friends['data'] as $friend)
                <div class="friend-item">
                    <div class="item-header">
                    <img class="profile-img"src="{{$friend['picture']['data']['url']}}" href="">
                    <p>{{$friend['name']}}</p>
                    </div>
                    <div class="item-footer">
                        <p>id : {{$friend['id']}}</p>
                        <a class="btn btn-primary" href="{{route('social.add',['id'=>$friend['id']])}}">Gửi tin nhắn</a>
                    </div>
                </div>
            @endforeach
        </div>
@endsection
