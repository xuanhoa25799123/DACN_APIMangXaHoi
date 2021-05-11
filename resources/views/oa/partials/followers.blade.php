@foreach($followers as $index=>$follower)
            <tr>
                <th scope="row">{{$index}}</th>

                <td> <img class="follower-image" src="{{$follower['avatar']}}" alt=""></td>
                <td> {{$follower['display_name']}}</td>
                <td><button type="button" class="btn btn-outline-primary"><i class="fa fa-chat"></i>&nbsp; Chat</button>
                    <button type="button" class="btn btn-outline-primary">Khác</button>
                </td>
            </tr>
        @endforeach