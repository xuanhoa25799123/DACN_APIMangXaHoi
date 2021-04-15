@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/send-message.css')}}">
@endsection

@section('content')
    <div class="send-container">
            <div class="send-header">Gửi tin nhắn đến
            @foreach($receives as $receive)
                <div class="send-profile">
                    <img class="send-img" src="{{$receive['picture']['data']['url']}}" alt="">
                    <label class="send-label">{{$receive['name']}}</label>
                </div>
                @endforeach
            </div>
    </div>
@endsection
