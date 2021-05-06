@extends('social.layouts.admin')

@section('css')
        <link rel="stylesheet" href="{{asset('/css/status-preview.css')}}">
    <link rel="stylesheet" href="{{asset('/css/preview.css')}}">
@endsection
@section('js')
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('/js/preview.js')}}"></script>
    <script src="{{asset('/js/post-status.js')}}"></script>
@endsection
@section('content')
    <div class="send-container">
        <h4>Tạo bài viết mới</h4>
        <div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control post-status-link" name="link">
            </div>
            <div class="form-group">
                <label>Tin nhắn</label>
                <textarea class="form-control" name="message"></textarea>
            </div>
            <button type="button" class="btn btn-primary send-btn"><i class="fa fa-send"></i>&nbsp;Đăng bài viết</button>
            <button type="button" class="btn btn-danger delete-btn"><i class="fa fa-trash"></i>&nbsp;Xoá nội dung</button>
        </div>
        <div class="preview-container">
            <div class="preview-header">
                <p class="preview-header-p">Xem trước bài đăng</p>
                <button class="btn-close preview-close">x</button>
            </div>
            <div class="preview-sub-container">
                @include('social.partials.status-preview')
            </div>
            <div class="preview-footer">
                <button class="btn btn-primary btn-post-status">Đăng bài viết</button>
                <button class="btn btn-danger preview-close">Huỷ</button>
            </div>
        </div>

    </div>
@endsection
