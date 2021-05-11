@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">

@endsection
@section('js')
 <link rel="stylesheet" href="{{asset('/js/create-article-2.js')}}">
@endsection
@section('content')

    <form action="" method="POST">
        <div class="create-container">
        <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea class="form-control" rows="5" maxlength="300"></textarea>
        </div>
        <div class="form-group inline-form">
            <label>Tác giả</label>
            <input class="form-control" name="author">
        </div>
        <div class="form-group inline-form">
            <label>Nội dung</label>
            <textarea class="form-control" name="content" rows="10"></textarea>
        </div>
        </div>
        <div class="right-content">
            <div class="form-group">
                <label>Video / Ảnh đại diện</label>
                <div class="cover-container">
                    <div class="cover-header">
                        <button class="video-button active-button">Video</button>
                        <button class="image-button">Ảnh</button>
                    </div>
                    <div class="cover-content">
                        <div class="select-content video-content active">
                            <div class="video-info">
                              <i class="fa fa-film icon"></i>
                              <p class="photo-text">Click để chọn video</p>
                              </div>
                              <div class="video-preview">
                                    <img src="" class="preview-video">
                              </div>
                        </div>
                        <div class="select-content image-content">
                            <input type="text" class="form-control image-input" placeholder="Paste link tại đây...">
                            <div class="image-info">
                                 <i class="fa fa-image icon"></i>
                                <p class="photo-text">Nhập url của ảnh</p>
                            </div>
                            <div class="image-preview">
                                    <img src="" class="preview-image">
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </form>


@endsection
