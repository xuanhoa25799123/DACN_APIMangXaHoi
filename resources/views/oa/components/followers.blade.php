@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/follower.css')}}">
@endsection
@section('js')

@endsection
@section('content')
    <div class="header">
        <p>Tổng số: <strong>{{$total}}</strong></p>
        <input type="text" class="search" placeholder = "Nhập tên hiển thị">
        <button class="btn btn-primary"><i class="fa fa-search"></i>&nbsp; Tìm</button>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th>#</th>
            <th >Hình đại diện</th>
            <th>Tên hiển thị</th>
            <th >Giới tính</th>
            <th style="width:">Thao tác</th>
        </tr>
        </thead>
        <tbody>
        @foreach($followers as $index=>$follower)
            <tr>
                <th scope="row">{{$index}}</th>

                <td> <img class="follower-image" src="{{$follower['avatar']}}" alt=""></td>
                <td> {{$follower['display_name']}}</td>
                <td>  @if($follower['user_gender']=="1")
                        Nam
                    @else
                       Nữ
                    @endif
                </td>
                <td><button type="button" class="btn btn-outline-primary"><i class="fa fa-message"></i>&nbsp; Chat</button>
                    <button type="button" class="btn btn-outline-primary">Khác</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
