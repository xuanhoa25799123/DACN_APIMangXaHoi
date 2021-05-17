 @foreach($videos as $index=>$video)
            <tr id="row-{{$video->id}}">
                <th style="text-align:center" scope="row">{{$index+1}}</th>
                <td>{{date('d-m-Y H:i:s',substr((string)$video->create_date,0,10))}} 
                <div class="more-info">
                    <i class="fa fa-info-circle info-icon"></i>
                    <div class="last-update">
                    <p>Cập nhật lần cuối vào {{date('d-m-Y H:i:s',substr((string)$video->update_date,0,10))}}</p>
                    </div>
                </div>
                </td>
                <td  style="text-align:center"> <img class="article-image" src="{{$video->thumb}}" alt=""></td>
                <td> {{$video->title}}</td>
                <td  style="text-align:center"> {{$video->total_view}}</td>
                <td  style="text-align:center">{{$video->total_share}}</td>
                <td  style="text-align:center">
                    @if($video->status=="show")
                    hiện
                    <!-- <label class="checkbox-inline">
                        <input type="checkbox" checked data-toggle="toggle">
                    </label> -->
                    @else
                    ẩn
                        <!-- <label class="checkbox-inline">
                            <input type="checkbox" data-toggle="toggle">
                        </label> -->
                        @endif
                </td>

                <td  style="text-align:center"><a href="/oa/article/edit/{{$video->id}}"class="btn btn-outline-primary"><i class="fa fa-edit"></i>&nbsp; Sửa</a>
                    <button type="button" data-id="{{$video->id}}" class="btn btn-outline-primary article-delete">Xoá bài viết</button>
                </td>
            </tr>
@endforeach