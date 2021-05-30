@extends('oa.layouts.admin')

@section('css')
        <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">
          <link rel="stylesheet" href="{{asset('/css/video-popup.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection
@section('js')
  <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('/js/video-upload.js')}}"></script>
      <script src="{{asset('/js/create-article-2.js')}}"></script>
     <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
        <div class="create-container">
        <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề (<span style="color:red">*</span>)</label>
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50" required>
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn (<span style="color:red">*</span>)</label>
            <textarea name="description" class="form-control" rows="5" maxlength="300" required></textarea>
        </div>
        <div class="form-group inline-form">
            <label>Tác giả</label>
            <input class="form-control" name="author" >
        </div>
         <div class="form-group inline">
            <div class="form-group">
             <label>Trạng thái</label>
              <label class="checkbox-inline">
                        <input type="checkbox" checked data-toggle="toggle" name="status">
            </label>
            </div>
             <div class="form-group">
             <label>Bình luận</label>
              <label class="checkbox-inline">
                        <input type="checkbox" checked data-toggle="toggle" name="comment">
            </label>
            </div>
        </div>

        <div class="form-group inline-form">
            <label>Nội dung (<span style="color:red">*</span>)</label>
            <textarea class="form-control" name="content" rows="10"></textarea>
        </div>
        </div>        
        <div class="right-content">
              <div class="form-group">
                <label style="font-size:12px">Video / Ảnh đại diện (<span style="color:red">*</span>)</label>
                <div class="cover-container">
                <div class="cover-header">
                       <button type="button"class="image-button active-button">Ảnh</button>
                        <button type="button"class="video-button">Video</button>
                 
                    </div>
                    <div class="cover-content">
                        <div class="select-content image-content">
                            <input name="photo_url" type="text" class="form-control image-input" placeholder="Paste link tại đây...">
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
                        <div class="select-content video-content">
                            <div class="video-info" data-toggle="modal" data-target="#myModal">
                                <div class="sub-video-info">
                              <i class="fa fa-film icon"></i>
                              <p class="photo-text">Click để chọn video</p>
                              </div>
                                      <div class="video-preview">
                                    <img src="" class="preview-video">
                              </div>
                              </div>
                      
                        </div>
                        @include('oa.partials.video-popup')
                      
                    </div>
                </div>
            </div>
        </div>
        </div>
            <div class="loader-container">
                <div class="loader"></div>
            </div>
   </div>
      <button type="submit" class="btn btn-primary submit-button" data-href="{{route('store-article')}}">Đăng bài</button>
@endsection
