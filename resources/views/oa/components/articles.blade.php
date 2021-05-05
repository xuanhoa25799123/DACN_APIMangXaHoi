@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/article.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Ngày xuất bản</th>
                <th scope="col">Hình đại diện</th>
                <th scope="col">Tên bài viết</th>
                <th scope="col">Lượt xem</th>
                <th scope="col">Lượt chia sẻ</th>
                <th scope="col">Trạng thái</th>
                <th scope="col">Thao tác</th>
            </tr>
            </thead>
            <tbody>
            @foreach($articles as $index=>$article)
            <tr>
                <th scope="row">{{$index}}</th>
                <td>{{date('d-m-Y H:i:s',substr((string)$article->create_date,0,10))}} <p>Cập nhật lần cuối vào {{date('d-m-Y H:i:s',substr((string)$article->update_date,0,10))}}</p></td>
                <td> <img class="article-image" src="{{$article->thumb}}" alt=""></td>
                <td> {{$article->title}}</td>
                <td> {{$article->total_view}}</td>
                <td>{{$article->total_share}}</td>
                <td>
                    @if($article->status=="show")
                    <label class="checkbox-inline">
                        <input type="checkbox" checked data-toggle="toggle">
                    </label>
                    @else
                        <label class="checkbox-inline">
                            <input type="checkbox" data-toggle="toggle">
                        </label>
                        @endif
                </td>

                <td><button type="button" class="btn btn-outline-primary"><i class="fa fa-edit"></i>&nbsp; Sửa</button>
                    <button type="button" class="btn btn-outline-primary">Khác</button>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
@endsection
