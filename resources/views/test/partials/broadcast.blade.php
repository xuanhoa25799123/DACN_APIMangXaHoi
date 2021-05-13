 @foreach($articles as $index=>$article)
            <tr>
                <th style="text-align:center" scope="row">{{$index+1}}</th>
                <td>{{date('d-m-Y H:i:s',substr((string)$article->create_date,0,10))}} 
                </td>
                <td  style="text-align:center"> <img class="article-image" src="{{$article->thumb}}" alt=""></td>
                <td> {{$article->title}}</td>
                <td  style="text-align:center">
                    @if($article->status=="show")
                    hiện
                    @else
                       ẩn
                    @endif
                </td>

                <td style="text-align:center">
                    <button type="button" data-id="{{$article->id}}" class="btn btn-outline-primary select-broadcast">Chọn</button>
                </td>
            </tr>
            
@endforeach