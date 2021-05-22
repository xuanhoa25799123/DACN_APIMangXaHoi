@extends('test.layouts.admin')

@section('content')
    <form action="{{route('uploading-video')}}" method="POST" enctype="multipart/form-data" >
    @csrf
    <input type="file" name="video">
    <button type="submit">submit vidoe</button>
    </form>
@endsection

