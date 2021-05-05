@extends('oa.layouts.admin')

@section('css')

@endsection
@section('js')

@endsection
@section('content')
        @foreach($articles as $article)
            <p>{{$article['title']}}</p>
        <img src="{{$article['thumb']}}" alt="">
        <p>Lượt xem: {{$article['total_view']}}</p>
        <p>Lượt chia sẻ: {{$article['total_share']}}</p>
        <p>Trạng thái: {{$article['status']}}</p>
        <p>Ngày đăng: {{date('d/m/Y',$article['create_date'])}}</p>
            <p>Ngày chỉnh sửa gần nhất: {{date('d/m/Y',$article['update_date'])}}</p>
        @endforeach
@endsection
