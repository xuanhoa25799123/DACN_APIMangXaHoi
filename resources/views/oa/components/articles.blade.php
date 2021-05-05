@extends('oa.layouts.admin')

@section('css')

@endsection
@section('js')

@endsection
@section('content')
        <table class="table">
            <thead>
            <tr>
                <th scope="col">ID</th>
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
            @foreach($articles as $article)
            <tr>
                <th scope="row">{{$article->id}}</th>
                <td>{{date('d/m/Y',$article->create_date)}}</td>
                <td> <img src="{{$article->thumb}}" alt=""></td>
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
