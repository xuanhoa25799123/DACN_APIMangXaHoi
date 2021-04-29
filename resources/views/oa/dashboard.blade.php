@extends('oa.layouts.admin')

@section('title')
    <title>Dashboard</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
@endsection

@section('content')
    <div class="content">
        <p>Tên: {{$oa_info['name']}}</p>
        <p>Mô tả: {{$oa_info['description']}}</p>
        <p>Avatar: <img alt="" src="{{$oa_info['avatar']}}" class="oa-avatar"></p>
        <p>Cover: <img alt="" src="{{$oa_info['cover']}}"></p>
</div>

@endsection


