@extends('oa.layouts.admin')

@section('css')
    <!-- <link rel="stylesheet" href="{{asset('/css/create-article.css')}}"> -->
    <link rel="stylesheet" href="{{asset('/css/create-video.css')}}">
    <link rel="stylesheet" href="{{asset('/css/video-article.css')}}">
      <link rel="stylesheet" href="{{asset('/css/video-popup.css')}}">
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
        <script src="{{asset('/js/edit-video.js')}}"></script>
            <script src="{{asset('/js/video-upload.js')}}"></script>
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
            <input class="form-control" name="title" maxlength="150" value="{{$video->title}}">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn (<span style="color:red">*</span>)</label>
            <textarea class="form-control" name="description" rows="5" maxlength="300">{{$video->description}}</textarea>
        </div>
        <div class="form-group inline">
            <div class="form-group">
             <label>Trạng thái</label>
              <label class="checkbox-inline">
                             @if($video->status=="show")
                        <input type="checkbox" checked data-toggle="toggle" name="status" data-size="sm">
                    @else
                            <input type="checkbox" data-toggle="toggle" name="status" data-size="sm">
                @endif
            </label>
            </div>
             <div class="form-group">
             <label>Bình luận</label>
              <label class="checkbox-inline">
                            @if($video->comment=="show")
                        <input type="checkbox" checked data-toggle="toggle" name="comment" data-size="sm">
                    @else
                            <input type="checkbox" data-toggle="toggle" name="comment" data-size="sm">
                @endif
            </label>
            </div>
        </div>
        <div class="form-group inline-form">
            <label>Video (<span style="color:red">*</span>)</label>
            <div class="video-container" data-toggle="modal" data-target="#myModal">
                  <input id="hidden-video-id" type="hidden" value="{{$video->video_id}}"> 
                   <div class="video-preview">
                             <p class="video-change"><i class="fa fa-video"></i> &nbsp; Chọn lại</p>
                            <img src="{{$video->avatar}}" class="preview-video">
                                 <i class="fa fa-play video-preview-icon"></i>
                    </div>
          </div>
            @include('oa.partials.video-popup')
</div>
            <!-- <input type="file" name="video" id="upload-video" /> -->
        </div>
            </div>
            <div class="right-content">
                <div class="form-group">
                    <label>Ảnh đại diện</label>
                    <div class="select-content image-content">
                            <input name="photo_url" value="{{$video->avatar}}" type="text" class="form-control image-input" placeholder="Paste link tại đây...">
                            <div class="image-info">
                                <div class="sub-image-info" style="display:none">
                                 <i class="fa fa-image icon"></i>
                                    <p class="photo-text">Nhập url của ảnh</p>
                                 </div>
                                      <div class="image-preview" >
                                            <img src="{{$video->avatar}}" class="preview-image">
                                     </div>
                            </div>
                      
                        </div>
                </div>
            </div>
         
        </div>

        <button type="button"  data-href="{{route('update-video',['id'=>$video->id])}}" class="btn btn-primary submit-button">Cập nhật</button>



@endsection
