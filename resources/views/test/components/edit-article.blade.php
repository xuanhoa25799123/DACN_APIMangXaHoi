@extends('test.layouts.admin')

@section('css')
    <!-- 
        <link rel="stylesheet" href="{{asset('/css/create-article.css')}}"> -->
        <link rel="stylesheet" href="{{asset('/css/article-edit.css')}}">

@endsection
@section('js')
    <script src="{{asset('/js/article-edit.js')}}"></script>
@endsection
@section('content')

    <form action="{{route('test-update-article')}}" method="POST">
        @csrf;
        <div class="create-container">
        <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50" value="{{$article->title}}">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea name="description" class="form-control" rows="5" maxlength="300">{{$article->description}}</textarea>
        </div>
        <div class="form-group inline-form">
            <label>Tác giả</label>
            <input class="form-control" name="author" value="{{$article->author}}">
        </div>
        <div class="form-group inline-form">
            <label>Nội dung</label>
            <textarea class="form-control" name="content" rows="10">{{$article->body[0]->content}}</textarea>
        </div>
        </div>
        <input type="hidden" name="id" value="{{$article->id}}">

        
        <div class="right-content">
              <div class="form-group">
                <label>Video / Ảnh đại diện</label>
                <div class="cover-container">
                  
                    <div class="cover-content">
                          
                        <div class="select-content image-content">
                           
                            <input name="photo_url" type="text" class="form-control image-input" placeholder="Paste link tại đây..." value="{{$article->cover->photo_url}}">
                            <div class="image-info">
                                <div class="sub-image-info">
                                 <i class="fa fa-image icon"></i>
                                    <p class="photo-text">Nhập url của ảnh</p>
                                 </div>
                             
                                      <div class="image-preview">
                                    <img src="{{$article->cover->photo_url}}" class="preview-image">
                              </div>
                            </div>
                      
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Sửa</button>
    </form>


@endsection
