@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/send-message.css')}}">
@endsection

@section('content')
    <div class="send-container">
            <div class="send-header">Gửi tin nhắn đến &nbsp;
            @foreach($receives as $receive)
                <div class="send-profile">
                    <img class="send-img" src="{{$receive['picture']['data']['url']}}" alt="">
                    <p class="send-name">{{$receive['name']}}</p>
                </div>
                @endforeach
            </div>
        <form action="{{route('send',['sendIds'=>$sendIds])}}" method="POST">
            @csrf
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" name="link">
            </div>
            <div class="form-group">
                <label>Tin nhắn</label>
                <textarea class="form-control" name="message"></textarea>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>Gửi tin nhắn</button>
            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>Xoá nội dung</button>
        </form>
    </div>
@endsection
