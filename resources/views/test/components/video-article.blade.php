@extends('test.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">
    <link rel="stylesheet" href="{{asset('/css/video-article.css')}}">

@endsection
@section('js')
        <script src="{{asset('/js/test/create-article.js')}}"></script>
            <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
@endsection
@section('content')
    <form action="" method="POST">
        <div class="create-container">
            <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề</label>
            <input class="form-control" id="title" maxlength="150">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea class="form-control" id="link" rows="5" maxlength="300"></textarea>
        </div>
        <div class="form-group inline-form">
            <label>Video</label>
            <label for="upload-video" class="input-video">
                <video controls class="video-player">
                    <source src="" id="video_here">
                        Your browser does not support HTML5 video.
                </video>
                   <p class="video-change"><i class="fa fa-video"></i> &nbsp; Chọn lại</p>
                <div class="temp">
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
                    <label for="upload-photo" class="cover-photo">
                        <img id="cover-image" src="">
                                   <p class="cover-change"><i class="fa fa-camera"></i> &nbsp; Thay đổi ảnh</p>
                        <div class="temp">
             
                        <i class="fa fa-photo icon"></i>
                        <p class="photo-text">Chọn ảnh cover sẽ xuất hiện khi video được chọn</p>
                        </div>
                    </label>
                    <input type="file" name="photo" id="upload-photo" >
                </div>
            </div>
        </div>
        <button type="button" data-href="/create-video" class="btn btn-primary submit-button">Xuất bản</button>
    </form>

@endsection
