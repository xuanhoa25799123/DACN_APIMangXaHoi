@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/send-message.css')}}">
    <link rel="stylesheet" href="{{asset('/css/preview.css')}}">
@endsection
@section('js')
    <script src="{{asset('/js/send-message.js')}}"></script>
    <script src="{{asset('/js/preview.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
@endsection
@section('content')
    <h4>Gửi tin nhắn cho bạn bè</h4>
    <div class="send-container">
        <div>
            <div class="send-header">
                <p>Gửi tin nhắn đến &nbsp;</p>
                @foreach($receives as $friend)
                    <div class="send-profile">
                        <img class="send-img" src="{{$friend['picture']['data']['url']}}" alt="">
                        <div class="send-name-container">
                            <div class="arrow"></div>
                            <p class="send-name">{{$friend['name']}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="form-group">
                <label>Link</label>
                <input class="form-control" name="link" placeholder="nhấp link">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" rows="5" placeholder="nhấp nội dung"></textarea>
            </div>
            <button type="button" class="btn btn-primary send-btn" data-href="{{route('send',['sendIds'=>$sendIds])}}"><i class="fa fa-send"></i> Gửi tin nhắn</button>
            <button type="button" class="btn btn-danger send-btn"><i class="fa fa-trash"></i> Xoá</button>
        </div>
        <div class="preview-container">
            <div class="preview-header">
                <p class="preview-header-p">Xem trước tin nhắn</p>
                <button class="btn-close preview-close">x</button>
            </div>
            <div class="preview-sub-container">
                @include('partials.send-preview')
            </div>
            <div class="preview-footer">
                <button class="btn btn-primary btn-send-message btn-margin" data-href="{{route('invite',['sendIds'=>$sendIds])}}">Gửi tin nhắn</button>
                <button class="btn btn-danger preview-close">Huỷ</button>
            </div>
        </div>
    </div>
@endsection


{{--        <form action="{{route('test-send',['sendIds'=>$sendIds])}}" method="POST">--}}
{{--            @csrf--}}
{{--            <div class="send-header">--}}
{{--            <p>Gửi tin nhắn đến &nbsp;</p>--}}
{{--                @foreach($receives as $friend)--}}
{{--                    <div class="send-profile">--}}
{{--                        <img class="send-img" src="{{$friend['picture']['data']['url']}}" alt="">--}}
{{--                        <p class="send-name">{{$friend['name']}}</p>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Link</label>--}}
{{--                <input class="form-control" name="link" placeholder="nhấp link">--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}
{{--                <label>Message</label>--}}
{{--                <textarea class="form-control" name="message" rows="5" placeholder="nhấp nội dung"></textarea>--}}
{{--            </div>--}}
{{--            <button type="submit" class="btn btn-primary send-btn"><i class="fa fa-send"></i> Gửi tin nhắn</button>--}}
{{--            <button type="button" class="btn btn-danger send-btn"><i class="fa fa-trash"></i> Xoá</button>--}}
{{--        </form>--}}
