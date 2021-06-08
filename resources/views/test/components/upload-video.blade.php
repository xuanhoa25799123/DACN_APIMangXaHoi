@extends('test.layouts.admin')

@section('js')
            <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
    <script src="{{asset('/js/test/upload-video.js')}}"></script>
@endsection

@section('content')
    <button class="btn btn-primary btn-test">Hehe</button>
    <label for="uploadFile">
        <p>ahehehe</p>
    </label>
    <input type="file" name="video" id="uploadFile" style="display:none" data-href="{{route('test-upload-video')}}">

    <button class="btn btn-primary btn-sw">SweetAlert2</button>
@endsection

