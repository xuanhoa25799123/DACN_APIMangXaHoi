@extends('oa.layouts.admin')

@section('css')

@endsection
@section('js')

@endsection
@section('content')
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
