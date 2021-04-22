@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/profile.css')}}">
@endsection
@section('content')
    <h4>Thông tin</h4>
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-background">
                <img class="profile-img" alt ="" src="{{$profile['picture']['data']['url']}}">
            </div>
        </div>
        <div class="profile-footer">
            <p class="name">{{$profile['name']}}</p>
            <div class="profile-info">
              
                @if($profile['gender']=="male")
                    <p>GT: Nam</p>
                @else
                    <p>GT: Nữ</p>
                @endif
                <p>Ngày sinh: {{$profile['birthday']}}</p>
            </div>
        </div>
    </div>
@endsection
