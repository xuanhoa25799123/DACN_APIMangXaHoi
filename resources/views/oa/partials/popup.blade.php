
        <div class="popup-friend-list">
    @foreach($friends as $friend)
        <div class="popup-friend-item">
            @if($friend['gender']=="Male")
            <input type="checkbox" class="cb item-male" value="{{$friend['id']}}" name="selected">
            @else
                <input type="checkbox" class="cb item-female" value="{{$friend['id']}}" name="selected">
            @endif
            <img class="popup-friend-img" src="{{$friend['picture']['data']['url']}}">
            <p class="popup-friend-name">{{$friend['name']}}</p>
        </div>
    @endforeach
        </div>


