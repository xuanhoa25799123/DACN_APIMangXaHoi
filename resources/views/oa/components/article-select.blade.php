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
                <a class="article-item" href="{{route('text-article')}}">
                    <div class="article-item-circle">
                        <i class="article-item-icon fa fa-images"></i>
                    </div>
                    <p class="article-item-text">Bài viết văn bản</p>
                </a>
                <a class="article-item" href="{{route('video-article')}}">
                    <div class="article-item-circle">
                        <i class="article-item-icon fa fa-play"></i>
                    </div>
                    <p class="article-item-text">Bài viết video</p>
                </a>
            </div>
        </div>
@endsection
