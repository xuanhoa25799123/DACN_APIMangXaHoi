@extends('layouts.admin')


@section('title')
    <title>Đăng nhập zalo</title>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/login/style.css">
    @endsection
@section('content')
    <div class="background">

    </div>
    <a class="login-button btn btn-primary" href="{{$loginUrl}}">Đăng nhập zalo</a>
@endsection


