@extends('test.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/send-message.css')}}">
    <link rel="stylesheet" href="{{asset('/css/preview.css')}}">
    <link rel="stylesheet" href="{{asset('/css/invite-preview.css')}}">
@endsection
@section('js')
    <script src="{{asset('/js/send-invite.js')}}"></script>
    <script src="{{asset('/js/preview.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
@endsection
@section('content')
    <h4>Gửi lời mời vào ứng dụng</h4>
    <div class="send-container">
        <div class="send-header">Mời &nbsp;
            @foreach($receives as $receive)
                <div class="send-profile">
                    <img class="send-img" src="{{$receive['picture']['data']['url']}}" alt="">
                    <div class="send-name-container">
                        <div class="arrow"></div>
                    <p class="send-name">{{$receive['name']}}</p>
                    </div>
                </div>
            @endforeach
            &nbsp; tham gia ứng dụng
        </div>
            <div>
            <div class="form-group">
                <label>Tin nhắn</label>
                <textarea class="form-control" name="message"></textarea>
            </div>
            <button type="button" class="btn btn-primary invite-btn"><i class="fa fa-send"></i>&nbsp;Gửi lời mời</button>
            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Xoá nội dung</button>
            </div>
    </div>
    <div class="preview-container">
        <div class="preview-header">
            <p class="preview-header-p">Xem trước lời mời</p>
            <button class="btn-close preview-close">x</button>
        </div>
        <div class="preview-sub-container">
            @include('test.partials.invite-preview')
        </div>
        <div class="preview-footer">
            <button class="btn btn-primary btn-send-invite btn-margin" data-href="{{route('test-invite',['sendIds'=>$sendIds])}}">Gửi lời mời</button>
            <button class="btn btn-danger preview-close">Huỷ</button>
        </div>
    </div>
@endsection
