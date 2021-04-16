@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/send-message.css')}}">
@endsection

@section('content')
    <div class="send-container">
        <form action="{{route('post-status')}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" name="link">
            </div>
            <div class="form-group">
                <label>Tin nhắn</label>
                <textarea class="form-control" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>&nbsp;Đăng bài viết</button>
            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Xoá nội dung</button>
        </form>
    </div>
@endsection
