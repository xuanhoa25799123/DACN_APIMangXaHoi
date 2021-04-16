@foreach($friends as $friend)
    <div class="friend-item">
        <div class="item-header">
            <div class="item-background">
                <img class="profile-img"src="{{$friend['picture']['data']['url']}}" alt="">
            </div>
        </div>
        <div class="item-footer">
            <p class="name">{{$friend['name']}}</p>
            <a class="send-message" href="{{route('send-invite',['id'=>$friend['id']])}}"><i class="fa fa-send" /> Mời tham gia</a>
        </div>
    </div>
@endforeach

