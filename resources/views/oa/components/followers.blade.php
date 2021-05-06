@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/follower.css')}}">
@endsection
@section('js')

@endsection
@section('content')
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Hình đại diện</th>
            <th scope="col">Tên hiển thị</th>
            <th scope="col">Giới tính</th>
            <th scope="col">Thao tác</th>
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
                <td><button type="button" class="btn btn-outline-primary"><i class="fa fa-edit"></i>&nbsp; Thao tác</button>
                    <button type="button" class="btn btn-outline-primary">Khác</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @foreach($followers as $follower)
        <img src="{{$follower['avatar']}}" alt="">
        <p>Giới tính:    @if($follower['user_gender']=="1")
            <p>GT: Nam</p>
        @else
            <p>GT: Nữ</p>
            @endif</p>
        <p>Name: {{$follower['display_name']}}</p>
    @endforeach
@endsection
