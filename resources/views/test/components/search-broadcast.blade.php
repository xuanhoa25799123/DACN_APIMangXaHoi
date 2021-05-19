@extends('test.layouts.admin')

@section('css')
    <!-- 
        <link rel="stylesheet" href="{{asset('/css/create-article.css')}}"> -->
        <link rel="stylesheet" href="{{asset('/css/article-edit.css')}}">

@endsection
@section('js')
    <script src="{{asset('/js/article-edit.js')}}"></script>
     <script src="{{asset('/js/test/broadcast.js')}}"></script>
@endsection
@section('content')

    <!-- <form action="{{route('test-search-broadcast')}}" method="POST">
        @csrf  -->
        <div class="form-inline">
       <input type="text" id="daterange" name="daterange">
       </div>
        <!-- <button type="submit" class="btn btn-primary">Tìm</button>
    </form> -->

@endsection

