@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">
    <link rel="stylesheet" href="{{asset('/css/video-article.css')}}">

@endsection
@section('js')

@endsection
@section('content')
    <form action="" method="POST">
        <div class="create-container">
            <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" maxlength="150">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea class="form-control" rows="5" maxlength="300"></textarea>
        </div>
        <div class="form-group inline-form">
            <label>Video</label>
            <label for="upload-video" class="input-video">
                <i class="fa fa-film photo-icon"></i>
                <p class="photo-text">Click để chọn video</p>
            </label>
            <input type="file" name="video" id="upload-video" />
        </div>
            </div>
            <div class="right-content">
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <label for="upload-photo" class="cover-photo">
                        <i class="fa fa-image photo-icon"></i>
                        <p class="photo-text">Chọn ảnh cover sẽ xuất hiện khi video được chọn</p>
                    </label>
                    <input type="file" name="photo" id="upload-photo" >
                </div>
            </div>
        </div>
    </form>

@endsection
