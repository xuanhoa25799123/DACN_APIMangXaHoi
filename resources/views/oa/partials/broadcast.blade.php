 @foreach($broadcasts as $index=>$broadcast)
            <tr>
                <th style="text-align:center" scope="row">{{$index+1}}</th>
                <td>{{date('d-m-Y H:i:s',substr((string)$broadcast->create_date,0,10))}} 
                </td>
                <td  style="text-align:center"> <img class="article-image" src="{{$broadcast->thumb}}" alt=""></td>
                <td> {{$broadcast->title}}</td>
                <td  style="text-align:center">
                    @if($broadcast->status=="show")
                    hiện
                    @else
                       ẩn
                    @endif
                </td>

                <td style="text-align:center">
                    @if($broadcast->selected)
                    <button type="button" data-id="{{$broadcast->id}}" class="btn btn-outline-primary select-broadcast broadcast-{{$broadcast->id}} selected">Đã chọn</button>
                    @else
                      <button type="button" data-id="{{$broadcast->id}}" class="btn btn-outline-primary select-broadcast broadcast-{{$broadcast->id}}">Chọn</button>
                    @endif
                </td>
            </tr>
@endforeach