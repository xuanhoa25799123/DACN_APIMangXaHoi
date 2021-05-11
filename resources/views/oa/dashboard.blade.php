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
        <p class="oa-info">THÔNG TIN OFFICIAL ACCOUNT</p>
        <div class="sub-container">
        <div class="image-container">
             <img alt="" src="{{$oa_info['cover']}}" class="background-image">
        </div>
        <div class="logo-container">
          <img alt="" src="{{$oa_info['avatar']}}" class="oa-image">
            <p class="oa-dashboard-name">{{$oa_info['name']}}</p>
        </div>
            <p class="oa-dashboard-sub-name">{{$oa_info['description']}}</p>
        </div>

</div>

@endsection


