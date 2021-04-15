 @foreach($friends as $friend)
        <div class="friend-item">
            <div class="item-header">
                <img class="profile-img"src="{{$friend['picture']['data']['url']}}" href="">
            </div>
            <div class="item-footer">
                <p class="name">{{$friend['name']}}</p>
                <a class="sent-message" href="{{route('social.add',['id'=>$friend['id']])}}">Gửi tin nhắn</a>
            </div>
        </div>
 @endforeach

