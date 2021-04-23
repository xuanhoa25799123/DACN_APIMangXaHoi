@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/friend-list.css')}}">
    <link rel="stylesheet" href="{{asset('/css/search-input.css')}}">
    <link rel="stylesheet" href="{{asset('/css/popup.css')}}">
@endsection
@section('js')
    <script src="{{asset('js/friend-search.js')}}"></script>
    <script src="{{asset('js/toggle-popup.js')}}"></script>
    <script src="{{asset('js/popup.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
@endsection
@section('content')
    <h4>Danh sách bạn bè đã vào ứng dụng</h4>
    <div class="search-container">
        <i class="search-logo fa fa-search"></i>
        <input type="text" name="search" id="friend-search-bar" placeholder="Tìm kiếm tên bạn bè">
    </div>
    <button class="btn btn-primary toggle-popup friend-list-button">Gửi tin nhắn</button>
    <p class="text">Đã có {{$total}} người bạn vào ứng dụng</p>
    <div class="list-friends">
        @include('partials.friends')
    </div>
    <div class="popup-container">
        <p class="popup-title">Chọn bạn bè nhận tin nhắn</p>
        @include('partials.popup')
        <div class="popup-footer">
            <div class="popup-filter">
                <input type="checkbox" class="cb filter-all">Tất cả
                <input type="checkbox" class="cb filter-male">Nam
                <input type="checkbox" class="cb filter-female">Nữ
            </div>
            <div class="popup-button-container">
                <button type="button" class="btn btn-primary friend-submit">Gửi tin nhắn</button>
                <button type="button" class="btn btn-danger exit">Thoát</button>
            </div>
        </div>
    </div>
@endsection
