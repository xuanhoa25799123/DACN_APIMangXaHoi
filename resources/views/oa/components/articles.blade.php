@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/article.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="{{asset('/js/article.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
    <div class="article-header">
    <div>
        <p class="total">Tổng số: <strong>{{$total}}</strong></p>
        <input type="text" id="article-search" class="search" placeholder = "Nhập tên bài viết">
    </div>
    <a href="{{route('oa-article-select')}}" class="btn btn-primary">Tạo bài viết mới</a>
    </div>
        <a href="{{route('oa-article-select')}}" class="btn btn-primary">Tạo bài viết mới</a>
        <table class="table">
            <thead>
            <tr>
                <th style="width:8%;text-align:center" scope="col">#</th>
                <th style="width:15%" scope="col">Ngày xuất bản</th>
                <th style="width:10%;text-align:center"scope="col">Hình đại diện</th>
                <th style="width:20%"scope="col">Tên bài viết</th>
                <th style="width:8%;text-align:center"scope="col">Lượt xem</th>
                <th style="width:8%;text-align:center"scope="col">Lượt chia sẻ</th>
                <th style="width:8%;text-align:center"scope="col">Trạng thái</th>
                <th style="width:20%;text-align:center"scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody class="article-rows">
            @include('oa.partials.articles')
            </tbody>
        </table>
@endsection
