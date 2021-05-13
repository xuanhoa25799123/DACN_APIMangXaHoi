@extends('test.layouts.admin')

@section('css')
    <!-- 
        <link rel="stylesheet" href="{{asset('/css/create-article.css')}}"> -->
        <link rel="stylesheet" href="{{asset('/css/article-edit.css')}}">

@endsection
@section('js')
    <script src="{{asset('/js/article-edit.js')}}"></script>
@endsection
@section('content')

    <form action="{{route('test-search-broadcast')}}" method="POST">
        @csrf;
        <input type="datetime-local" name="start" class="form-control">
        <input type="datetime-local" name="end" class="form-control">
        <button type="submit" class="btn btn-primary">Tìm</button>
    </form>


@endsection
