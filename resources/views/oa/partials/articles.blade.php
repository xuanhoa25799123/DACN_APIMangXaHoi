 @foreach($articles as $index=>$article)
            <tr id="row-{{$article->id}}">
                <th style="text-align:center" scope="row">{{$index+1}}</th>
                <td>{{date('d-m-Y H:i:s',substr((string)$article->create_date,0,10))}} 
                <div class="more-info">
                    <div class="info-icon">
                        i
                    </div>
                    <div class="last-update">
                    <p>Cập nhật lần cuối vào {{date('d-m-Y H:i:s',substr((string)$article->update_date,0,10))}}</p>
                    </div>
                </div>
                </td>
                <td  style="text-align:center"> <img class="article-image" src="{{$article->thumb}}" alt=""></td>
                <td> {{$article->title}}</td>
                <td  style="text-align:center"> {{$article->total_view}}</td>
                <td  style="text-align:center">{{$article->total_share}}</td>
                <td  style="text-align:center">
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

                <td  style="text-align:center"><a type="button" data-id="{{$article->id}}"class="btn btn-outline-primary article-edit"><i class="fa fa-edit"></i>&nbsp; Sửa</button>
                    <button type="button" data-id="{{$article->id}}" class="btn btn-outline-primary article-delete">Xoá bài viết</button>
                </td>
            </tr>
@endforeach