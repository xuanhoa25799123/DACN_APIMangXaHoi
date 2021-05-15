@extends('test.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/paginate.css')}}">
@endsection

@section('content')

    <div class="paginate-container">
        {!!$paginate!!}
    </div>
    
@endsection
