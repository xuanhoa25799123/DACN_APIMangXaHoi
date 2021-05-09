@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/article-select.css')}}">

@endsection
@section('js')

@endsection
@section('content')
        <div class="article-select-container">
            <p class="article-select-header">Chọn loại bài viết</p>
            <div class="article-container">
                <a class="article-item">
                    <div class="article-item-circle">
                        <i class="article-item-icon fa fa-text"></i>
                    </div>
                    <p class="article-item-text">Bài viết văn bản</p>
                </a>
                <a class="article-item">
                    <div class="article-item-circle">
                        <i class="article-item-icon fa fa-video"></i>
                    </div>
                    <p class="article-item-text">Bài viết video</p>
                </a>
            </div>
        </div>
@endsection
