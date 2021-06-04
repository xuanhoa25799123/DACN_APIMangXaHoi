@extends('oa.layouts.admin')

@section('css')
    
        <link rel="stylesheet" href="{{asset('/css/video-popup.css')}}">
        <link rel="stylesheet" href="{{asset('/css/article-edit.css')}}">
         <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

@endsection
@section('js')
    <script src="{{asset('/js/article-edit.js')}}"></script>
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
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50" value="{{$article->title}}">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn (<span style="color:red">*</span>)</label>
            <textarea name="description" class="form-control" rows="5" maxlength="300">{{$article->description}}</textarea>
        </div>
        <div class="form-group inline-form">
            <label>Tác giả</label>
            <input class="form-control" name="author" value="{{$article->author}}">
        </div>
       
 
       <div class="form-group inline">
           <div class="form-group">
             <label>Trạng thái</label>
              <label class="checkbox-inline">
                @if($article->status=="show")
                        <input type="checkbox" checked data-toggle="toggle" name="status" data-size="sm">
                    @else
                            <input type="checkbox" data-toggle="toggle" name="status" data-size="sm">
                @endif
                   </label>
                </div>
                <div class="form-group">
                    <label>Bình luận</label>
                       <label class="checkbox-inline">
                    @if($article->comment=="show")
                        <input type="checkbox" checked data-toggle="toggle" name="comment" data-size="sm">
                    </label>
                    @else
                            <input type="checkbox" data-toggle="toggle" name="comment" data-size="sm">
                @endif
                 </label>
                </div>
        </div>
        <div class="form-group inline-form">
            <label>Nội dung (<span style="color:red">*</span>)</label>
            <textarea class="form-control" name="content" rows="10">{{$article->body[0]->content}}</textarea>
        </div>
        </div>
        <input type="hidden" name="id" value="{{$article->id}}">

        
        <div class="right-content">
              <div class="form-group">
                   <label style="font-size:12px">Ảnh đại diện / Video (<span style="color:red">*</span>)</label>
                <div class="cover-container">
                  
                    <div class="cover-content">
                          <div class="cover-header">
                          @if($article->cover->cover_type=="photo")
                       <button type="button"class="image-button active-button">Ảnh</button>
                        <button type="button"class="video-button">Video</button>
                        @else
                              <button type="button"class="image-button">Ảnh</button>
                        <button type="button"class="video-button active-button">Video</button>
                        @endif
                         </div>
                          <div class="cover-content">
                          @if($article->cover->cover_type=="photo")
                        <div class="select-content image-content">        
                            <input name="photo_url" type="text" class="form-control image-input" placeholder="Paste link tại đây..." value="{{$article->cover->photo_url}}">
                            <div class="image-info">
                                <div class="sub-image-info invisible">
                                 <i class="fa fa-image icon"></i>
                                    <p class="photo-text">Nhập url của ảnh</p>
                                 </div>
                                <div class="image-preview">
                                    <img src="{{$article->cover->photo_url}}" class="preview-image">
                              </div>
                            </div>
                      
                        </div>
                        <div class="select-content video-content invisible">
                            <div class="video-info">
                                <div class="video-info" style="cursor:pointer" data-toggle="modal" data-target="#myModal">
                                <div class="sub-video-info">
                              <i class="fa fa-film icon"></i>
                              <p class="photo-text">Click để chọn video</p>
                             </div>
                             <div class="video-preview" style="display:none">
                                    <img src="" class="preview-video">
                                       <i class="fa fa-play video-preview-icon"></i>
                              </div>
                               </div>
                              </div>
                      
                        </div>
                        @include('oa.partials.video-popup')
                        @else
                         <div class="select-content image-content invisible" >        
                            
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
                        <div class="select-content video-content">     
                             <input id="hidden-video-id" type="hidden" value="{{$article->cover->video_id}}"> 
                               <div class="video-info" style="cursor:pointer"data-toggle="modal" data-target="#myModal">
                                      <div class="video-preview">
                                    <img src="{{$article->cover->photo_url}}" class="preview-video">
                                        <i class="fa fa-play video-preview-icon"></i>
                                    </div>
                              </div>
                        </div>
                        @include('oa.partials.video-popup')
                        </div>
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
                  <div class="loader-container">
                <div class="loader"></div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary submit-button" data-href="{{route('update-article')}}">Sửa</button>
    
@endsection
