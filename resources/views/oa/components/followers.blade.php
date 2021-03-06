@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/follower.css')}}">
    <link rel="stylesheet" href="{{asset('/css/paginate.css')}}">
        <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.css')}}">
@endsection
@section('js')
    <script src="{{asset('/js/follower.js')}}"></script>
 
          <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.js')}}">
@endsection
@section('content')
    <div class="follower-header">
        <p class="total">Tổng số: <strong>{{$total}}</strong></p>
        <input type="text" id="follower-search" class="search" placeholder = "Nhập tên hiển thị">
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
    <div class="follower-footer">
    <p class="total">Hiển thị: <strong>20</strong></p>
    <div class="paginate-container">
        {!!$paginate!!}
    </div>
    </div>
    
@endsection
