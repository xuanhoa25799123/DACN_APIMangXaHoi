 @foreach($friends as $friend)
        <div class="friend-item">
            <div class="item-header">
                <img class="profile-img"src="{{$friend['picture']['data']['url']}}" href="">
            </div>
            <div class="item-footer">
                <p>{{$friend['name']}}</p>
                <a class="btn btn-primary" href="{{route('view.profile',['id'=>$friend['id']])}}">Xem thông tin</a>
                <a class="btn btn-primary" href="{{route('social.add',['id'=>$friend['id']])}}">Gửi tin nhắn</a>
            </div>
        </div>
 @endforeach

