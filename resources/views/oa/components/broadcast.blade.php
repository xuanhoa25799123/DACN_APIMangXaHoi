@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/article.css')}}">
      <link rel="stylesheet" href="{{asset('/css/broadcast.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="{{asset('/js/broadcast.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
    <a href="/oa/create-article" class="btn btn-info create-article">Tạo bài viết mới</a>
    <div class="article-header">
    <div class="article-header-left">
        <p class="total">Tổng số: <strong>{{$total}}</strong></p>
        <input type="text" id="broadcast-search" class="search" placeholder = "Nhập tên bài viết">
    </div>
    <div class="article-header-right">
        <input type="text" name="daterange">
    </div>
    </div>
        <table class="table">
            <thead>
            <tr>
                <th style="width:8%;text-align:center" scope="col">#</th>
                <th style="width:15%" scope="col">Ngày xuất bản</th>
                <th style="width:10%;text-align:center"scope="col">Hình đại diện</th>
                <th style="width:20%"scope="col">Tên bài viết</th>
                <th style="width:8%;text-align:center"scope="col">Trạng thái</th>
                <th style="width:20%;text-align:center"scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody class="article-rows">
            @include('oa.partials.broadcast')
            </tbody>
        </table>
         <button type="button" class="btn btn-primary send-broadcast">Gửi broadcast</button>
@endsection
