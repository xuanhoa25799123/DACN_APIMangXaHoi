@extends('layouts.admin')

@section('title')
    <title>Dashboard</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/dashboard/style.css')}}">
@endsection


@section('content')
    <div class="content">
{{--    <a class="btn btn-primary" href="{{route('oa.user')}}">Official account</a>--}}
{{--    <div class="profile">--}}
{{--        <img class="profile-img" src="{{$profile['picture']['data']['url']}}" href="">--}}

{{--    </div>--}}
{{--    <p>invitable friends</p>--}}
{{--    <div class="list-friends">--}}
{{--        @foreach($invitable_friends['data'] as $friend)--}}
{{--            <div class="friend-item">--}}
{{--                <div class="item-header">--}}
{{--                    <img class="profile-img" src="{{$friend['picture']['data']['url']}}" href="">--}}
{{--                    <p>{{$friend['name']}}</p>--}}
{{--                </div>--}}
{{--                <div class="item-footer">--}}
{{--                    <p>id : {{$friend['id']}}</p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
{{--    <p>already in friends</p>--}}
{{--    <div class="list-friends">--}}
{{--        @foreach($friends['data'] as $friend)--}}
{{--            <div class="friend-item">--}}
{{--                <div class="item-header">--}}
{{--                <img class="profile-img"src="{{$friend['picture']['data']['url']}}" href="">--}}
{{--                <p>{{$friend['name']}}</p>--}}
{{--                </div>--}}
{{--                <div class="item-footer">--}}
{{--                    <p>id : {{$friend['id']}}</p>--}}
{{--                    <a class="btn btn-primary" href="{{route('social.add',['id'=>$friend['id']])}}">Gửi tin nhắn</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endforeach--}}
{{--    </div>--}}
</div>

@endsection


