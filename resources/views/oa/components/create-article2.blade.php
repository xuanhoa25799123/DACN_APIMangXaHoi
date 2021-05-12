@extends('oa.layouts.admin')

@section('css')
    <!-- 
        <link rel="stylesheet" href="{{asset('/css/create-article.css')}}"> -->
        <link rel="stylesheet" href="{{asset('/css/create-article.css')}}">

@endsection
@section('js')
    <script src="{{asset('/js/create-article-2.js')}}"></script>
@endsection
@section('content')

    <form action="{{route('store-article')}}" method="POST">
        @csrf;
        <div class="create-container">
        <div class="left-content">
        <div class="form-group inline-form">
            <label>Tiêu đề</label>
            <input class="form-control" name="title" placeholder="Tiêu đề bài viết" maxlength="50" required>
        </div>
        <div class="form-group inline-form">
            <label>Trích dẫn</label>
            <textarea name="description" class="form-control" rows="5" maxlength="300" required></textarea>
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
                    </div>
                </div>
            </div>
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Đăng bài</button>
    </form>
@endsection
