@extends('oa.layouts.admin')

@section('css')
    <!-- <link rel="stylesheet" href="{{asset('/css/create-article.css')}}"> -->
    <link rel="stylesheet" href="{{asset('/css/create-video.css')}}">
    <link rel="stylesheet" href="{{asset('/css/video-article.css')}}">
      <link rel="stylesheet" href="{{asset('/css/video-popup.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
        <script src="{{asset('/js/create-video.js')}}"></script>
            <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
              <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
                     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection
@section('content')
        <div class="create-container">
            <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề (<span style="color:red">*</span>)</label>
            <input class="form-control" name="title" maxlength="150">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn (<span style="color:red">*</span>)</label>
            <textarea class="form-control" name="description" rows="5" maxlength="300"></textarea>
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
            <label>Video (<span style="color:red">*</span>)</label>
            <div class="video-container" data-toggle="modal" data-target="#myModal">
                <div class="sub-video-info">
                        <i class="fa fa-film icon"></i>
                        <p class="photo-text">Click để chọn video</p>
                </div>
                   <div class="video-preview" style="display:none">
                             <p class="video-change"><i class="fa fa-video"></i> &nbsp; Chọn lại</p>
                            <img src="" class="preview-video">
                    </div>
          </div>
            @include('oa.partials.video-popup')
</div>
            <!-- <input type="file" name="video" id="upload-video" /> -->
        </div>
            </div>
            <div class="right-content">
                <div class="form-group">
                    <label>Ảnh đại diện (<span style="color:red">*</span>)</label>
                    <div class="select-content image-content">
                            <input name="photo_url" type="text" class="form-control image-input" placeholder="Paste link tại đây...">
                            <div class="image-info">
                                <div class="sub-image-info">
                                 <i class="fa fa-image icon"></i>
                                    <p class="photo-text">Nhập url của ảnh</p>
                                 </div>
                                      <div class="image-preview" style="display:none">
                                            <img src="" class="preview-image">
                                     </div>
                            </div>
                      
                        </div>
                </div>
            </div>
        </div>

        <button type="button"  data-href="{{route('store-video')}}" class="btn btn-primary submit-button">Xuất bản</button>



@endsection
