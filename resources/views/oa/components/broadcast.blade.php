@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/article.css')}}">
      <link rel="stylesheet" href="{{asset('/css/broadcast.css')}}">
    <link rel="stylesheet" href="{{asset('/css/paginate.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="{{asset('/js/broadcast.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
<div class="article-head">
    <div class="tab-container">
        <button class="tab-item tab-article active-tab">Bài viết</button>
        <button class="tab-item tab-video">Video</button>
    </div>
     <a href="/oa/create-article" class="btn btn-primary button-create-article">Tạo bài viết mới</a>
    <a href="/oa/create-video" class="btn btn-primary button-create-video" style="display:none">Tạo video mới</a>
</div>
<div class="article-broadcast">
    <div class="article-header">
    <div class="article-header-left">
        <p class="total-article">Tổng số: <strong>{{$total_article}}</strong></p>
         <p class="total-video" style="display:none">Tổng số: <strong>{{$total_video}}</strong></p>
        <input type="text" id="broadcast-search" class="search" placeholder = "Nhập tên bài viết">
    </div>
     <div class="article-header-right">
           <div class="time-filter">
             <!-- <p class="total">Lọc theo thời gian</p> -->
          <button class="btn btn-outline-info cancel-daterange"><i class="fa fa-close"></i> &nbsp; Xoá lọc</button>
        <input type="text" name="daterange" class="form-control" value="Lọc theo thời gian">
        </div>
    </div>
    </div>
        </div>
                <table class="article-table table">
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
         <table class="video-table table" style="display:none">
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
            <tbody class="video-rows">
            @include('oa.partials.video-broadcast')
            </tbody>

        </table>
                 <button type="button" class="btn btn-primary send-broadcast">Gửi broadcast</button>
        </div>

@endsection
