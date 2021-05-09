@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">

@endsection
@section('js')

@endsection
@section('content')
    <form action="" method="POST">
        <div class="create-container">
        <div class="form-group form-inline">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea class="form-control" rows="5" maxlength="300"></textarea>
        </div>
        <div class="form-group inline-form">
            <label>Video</label>
            <input class="form-control" name="author">
        </div>
        </div>
    </form>

@endsection
