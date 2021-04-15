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
                    <p class="send-label">{{$receive['name']}}</p>
                </div>
                @endforeach
            </div>
    </div>
@endsection
