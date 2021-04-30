@extends('oa.layouts.admin')

@section('css')

@endsection
@section('js')

@endsection
@section('content')
    @foreach($followers as $follower)
        <img src="{{$follower['avatar']}}" alt="">
        <p>Giới tính: {{$follower['gender']}}</p>
        <p>Name: {{$follower['name']}}</p>
    @endforeach
@endsection
