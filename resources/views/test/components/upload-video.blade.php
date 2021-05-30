@extends('test.layouts.admin')

@section('js')

    <script src="{{asset('/js/test/upload-video.js')}}"></script>
@endsection

@section('content')

    <label for="uploadFile">
        <p>ahehehe</p>
    </label>
    <input type="file" name="video" id="uploadFile" style="display:none" data-href="{{route('test-upload-video')}}">
@endsection

