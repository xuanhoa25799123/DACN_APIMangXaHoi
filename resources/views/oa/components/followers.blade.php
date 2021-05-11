@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/follower.css')}}">
@endsection
@section('js')
    <script src="{{asset('/js/follower.js')}}"></script>
@endsection
@section('content')
    <div class="follower-header">
        <p class="total">Tổng số: <strong>{{$total}}</strong></p>
        <input type="text" class="search" placeholder = "Nhập tên hiển thị">
        <button class="btn btn-primary search-button"><i class="fa fa-search"></i>&nbsp; Tìm</button>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th style="width:8%;text-align:center">#</th>
            <th style="width:10%;text-align:center">Hình đại diện</th>
            <th style="width:40%">Tên hiển thị</th>
        
            <th style="width:30%;text-align:center">Thao tác</th>
        </tr>
        </thead>
        <tbody class="follower-rows">
            @include('oa.partials.followers')
        </tbody>
    </table>
@endsection
