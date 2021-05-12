 @foreach($articles as $index=>$article)
            <tr id="row-{{$article->id}}">
                <th style="text-align:center" scope="row">{{$index+1}}</th>
                <td>{{date('d-m-Y H:i:s',substr((string)$article->create_date,0,10))}} <p>Cập nhật lần cuối vào {{date('d-m-Y H:i:s',substr((string)$article->update_date,0,10))}}</p></td>
                <td  style="text-align:center"> <img class="article-image" src="{{$article->thumb}}" alt=""></td>
                <td> {{$article->title}}</td>
                <td  style="text-align:center"> {{$article->total_view}}</td>
                <td  style="text-align:center">{{$article->total_share}}</td>
                <td  style="text-align:center">
                    @if($article->status=="show")
                    <label class="checkbox-inline">
                        <input class="active-article" type="checkbox" checked data-toggle="toggle">
                    </label>
                    @else
                        <label class="checkbox-inline">
                            <input type="checkbox" data-toggle="toggle">
                        </label>
                        @endif
                </td>

                <td  style="text-align:center"><button type="button" class="btn btn-outline-primary"><i class="fa fa-edit"></i>&nbsp; Sửa</button>
                    <button type="button" id="article-delete" data-id="{{$article->id}}" class="btn btn-outline-primary">Xoá bài viết</button>
                </td>
            </tr>
@endforeach