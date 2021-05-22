 <div class='article-broadcast-rows'>
 @foreach($broadcasts as $index=>$broadcast)
 @if($broadcast->type=="normal")
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
                    <button type="button" data-id="{{$broadcast->id}}" class="btn btn-outline-primary select-broadcast broadcast-{{$broadcast->id}} selected">Bỏ chọn</button>
                    @else
                      <button type="button" data-id="{{$broadcast->id}}" class="btn btn-outline-primary select-broadcast broadcast-{{$broadcast->id}}">Chọn</button>
                    @endif
                </td>
            </tr>
            @else
            <p>asdasd</p>
            @endif
            
@endforeach
</div>
 <div class='video-broadcast-rows' style="display:none">
 @foreach($broadcasts as $index=>$broadcast)
 @if($broadcast->type=="video")
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
                    <button type="button" data-id="{{$broadcast->id}}" class="btn btn-outline-primary select-broadcast broadcast-{{$broadcast->id}} selected">Bỏ chọn</button>
                    @else
                      <button type="button" data-id="{{$broadcast->id}}" class="btn btn-outline-primary select-broadcast broadcast-{{$broadcast->id}}">Chọn</button>
                    @endif
                </td>
            </tr>
            @endif
@endforeach
</div>