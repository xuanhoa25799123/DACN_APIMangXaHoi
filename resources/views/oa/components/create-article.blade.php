@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">

@endsection
@section('js')
 <script src="{{asset('/js/create-article-2.js')}}"></script>
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
                        <button type="button"class="video-button active-button">Video</button>
                        <button type="button"class="image-button">Ảnh</button>
                    </div>
                    <div class="cover-content">
                        <div class="select-content video-content">
                            <div class="video-info"  data-toggle="modal" data-target="#exampleModal">
                                <div class="sub-video-info">
                              <i class="fa fa-film icon"></i>
                              <p class="photo-text">Click để chọn video</p>
                              </div>
                                      <div class="video-preview">
                                    <img src="" class="preview-video">
                              </div>
                              </div>
                      
                        </div>
                        <div class="select-content image-content">
                            <input type="text" class="form-control image-input" placeholder="Paste link tại đây...">
                            <div class="image-info">
                                <div class="sub-image-info">
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
        <div class="video-popup">
            <div class="close-video-popup">
                <i class="fa fa-close"></i>
                
            </div>
            <p>Chọn video</p>
            <div class="video-container">
                
                @foreach($videos as $video)
                    <div class="video-image">
                        <img src="{{$video->thumb}}" class="video-thumb">
                    </div>
                    @endforeach
            </div>
        </div>
        </div>

    </form>


@endsection
