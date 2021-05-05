@extends('oa.layouts.admin')

@section('title')
    <title>Dashboard</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/oa-dashboard.css')}}">
@endsection

@section('content')
    <div class="oa-dashboard">
        <div class="oa-dashboard-header">
        <p class="oa-dashboard-name">{{$oa_info['name']}}</p>
        <p class="oa-dashboard-sub-name">{$oa_info['description']}}</p>
        </div>
        <div class="image-container">
            <img alt="" src="{{$oa_info['cover']}}" class="background-image">
            <img alt="" src="{{$oa_info['avatar']}}" class="oa-image">
        </div>
</div>

@endsection


