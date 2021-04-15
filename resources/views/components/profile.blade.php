@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/profile.css')}}">
@endsection
@section('content')
    <div class="profile-container">
        <div class="profile-header">
            <div class="profile-background">
                <img class="profile-img" alt ="" src="{{$profile['picture']['data']['url']}}">
            </div>
        </div>
        <div class="footer">
            <p class="name">{{$profile['name']}}</p>
        </div>
    </div>
@endsection
