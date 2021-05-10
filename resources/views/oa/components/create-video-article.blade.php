@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">
    <link rel="stylesheet" href="{{asset('/css/video-article.css')}}">

@endsection
@section('js')
        <script src="{{asset('/js/create-article.js')}}"></script>
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
               <video controls class="video-player">
                    <source src="" id="video_here">
                        Your browser does not support HTML5 video.
                </video>
                 <p class="change-video"><i class="fa fa-video"></i> &nbsp; Chọn lại</p>
                 <div class="video-info">
                <i class="fa fa-film icon"></i>
                <p class="photo-text">Click để chọn video</p>
                </div>
            </label>
            <input type="file" name="video" id="upload-video" />
        </div>
            </div>
            <div class="right-content">
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <label for="upload-image" class="input-image">
                        <img class="cover-image" src="">
                        <p class="change-image"><i class="fa fa-camera"></i> &nbsp; Thay đổi ảnh</p>
                        <div class="image-info">
                            <i class="fa fa-image icon"></i>
                            <p class="photo-text">Chọn ảnh cover của video</p>
                        </div>
                    </label>
                    <input type="file" id="upload-image">
                </div>
            </div>
        </div>
        <button type="button" class="submit-button" data-href="/submit-video"></button>
    </form>

@endsection
