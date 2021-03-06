@extends('test.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/friend-list.css')}}">
    <link rel="stylesheet" href="{{asset('/css/search-input.css')}}">
    <link rel="stylesheet" href="{{asset('/css/popup.css')}}">
@endsection
@section('js')
    <script src="{{asset('js/test/invite-search.js')}}"></script>
    <script src="{{asset('js/test/toggle-popup.js')}}"></script>
    <script src="{{asset('js/test/popup.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
@endsection
@section('content')
    <h4>Mời bạn bè chưa vào ứng dụng</h4>
    <div class="search-container">
        <i class="search-logo fa fa-search"></i>
        <input type="text" name="search" id="invite-search-bar" placeholder="Tìm kiếm tên bạn bè">
    </div>
    <button class="btn btn-primary toggle-popup friend-list-button">Gửi lời mời</button>
    <p class="text">{{$total}} người bạn chưa tham gia ứng dụng</p>
    <div class="list-friends">
        @include('test.partials.invite')
        <div class="popup-container">
            <p class="popup-title">Chọn bạn bè gửi lời mời</p>
        @include('test.partials.popup')
            <div class="popup-footer">
                <div class="popup-filter">
                    <input type="checkbox" class="cb filter-all">Tất cả
                    <input type="checkbox" class="cb filter-male">Nam
                    <input type="checkbox" class="cb filter-female">Nữ
                </div>
                <div class="popup-button-container">
                    <button type="button" class="btn btn-primary invite-submit">Gửi lời mời</button>
                    <button type="button" class="btn btn-danger exit">Thoát</button>
                </div>
            </div>
    </div>
@endsection
