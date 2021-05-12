@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">

@endsection
@section('js')

@endsection
@section('content')

    <form action="" method="POST">
        <div class="create-container">
        <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50" value="{{$article->title}}">
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea class="form-control" rows="5" maxlength="300" value="{{$article->description}}"></textarea>
        </div>
        <div class="form-group inline-form">
            <label>Tác giả</label>
            <input class="form-control" name="author" value="{{$article->author}}">
        </div>
        <div class="form-group inline-form">
            <label>Nội dung</label>
            <textarea class="form-control" name="content" rows="10" value="{{$article->body[0]->content}}"></textarea>
        </div>
        </div>
        <div class="right-content">
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
    </form>


@endsection
