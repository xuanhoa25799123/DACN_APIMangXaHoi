 @foreach($friends as $friend)
        <div class="friend-item">
            <div class="item-header">
                <div class="item-background">
                <img class="profile-img" src="{{$friend['picture']['data']['url']}}" alt="">
                </div>
            </div>
            <div class="item-footer">
                <p class="name">{{$friend['name']}}</p>
                <a class="send-message" href="{{route('test-send-message',['id'=>$friend['id']])}}"><i class="fa fa-message"></i> Gửi tin nhắn</a>
            </div>
        </div>
 @endforeach

