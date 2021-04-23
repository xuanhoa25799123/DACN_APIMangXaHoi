@extends('test.layouts.admin')

@section('css')
    {{--    <link rel="stylesheet" href="{{asset('/css/send-message.css')}}">--}}
    <link rel="stylesheet" href="{{asset('/css/preview.css')}}">
@endsection
@section('js')
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
@endsection
@section('content')
    <form action="{{route('test-url-preview')}}" method="POST">
        @csrf
        <h4>Preview url</h4>
        <div>
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" name="link">
            </div>
            <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i>&nbsp;Đăng bài viết</button>
            <button type="button" class="btn btn-danger"><i class="fa fa-trash"></i>&nbsp;Xoá nội dung</button>
        </div>

    </form>
@endsection
