@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/friend-list.css')}}">
    <link rel="stylesheet" href="{{asset('/css/search-input.css')}}">
@endsection
@section('js')
    <script src="{{asset('js/search.js')}}"></script>
@endsection
@section('content')
    <div class="search-container">
        <i class="search-logo fa fa-search"></i>
        <input type="text" name="search" id="search-bar" placeholder="Tìm kiếm tên bạn bè">
    </div>
    <p class="text">{{$total}} người bạn chưa tham gia ứng dụng</p>
    <div class="list-friends">
        @include('partials.friends')
    </div>
@endsection
