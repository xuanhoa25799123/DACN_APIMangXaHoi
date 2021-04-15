@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/friend_list/style.css')}}">
    <link rel="stylesheet" href="{{asset('/css/search-input/style.css')}}">
    @endsection
@section('js')
    <script src="{{asset('js/search.js')}}"></script>
    @endsection
@section('content')
        <p>Đã có {{$total}} người bạn vào ứng dụng</p>
        <div class="search-container">
            <i class="search-logo fa fa-search"></i>
        <input type="text" name="search" id="search-bar" placeholder="Tìm kiếm tên bạn bè">
        </div>
        <div class="list-friends">
       @include('partials.friends')
        </div>
@endsection
