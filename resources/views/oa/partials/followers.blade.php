@foreach($followers as $index=>$follower)
            <tr>
                <th style="text-align:center"scope="row">{{$index+1}}</th>

                <td style="text-align:center"> <img class="follower-image" src="{{$follower['avatar']}}" alt=""></td>
                <td> {{$follower['display_name']}}</td>
            
                <td style="text-align:center"><a href="{{route('follower-chat',['id'=>$follower['user_id']])}}" class="btn btn-outline-primary"><i class="fa fa-chat"></i>&nbsp; Chat</a>
                </td>
            </tr>
        @endforeach