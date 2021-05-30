@extends('test.layouts.admin')

@section('js')

    <script src="{{asset('/js/test/upload-video.js')}}"></script>
@endsection

@section('content')
    <!-- <form action="{{route('uploading-video')}}" method="POST" enctype="multipart/form-data" >
    @csrf -->
    <input type="file" name="video"id="uploadFile">
    <button class="submit-button">submit vidoe</button>
    <!-- </form> -->
@endsection

