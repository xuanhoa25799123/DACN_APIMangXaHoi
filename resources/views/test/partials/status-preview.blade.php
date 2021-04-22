
<div class="preview-profile">
            <img class="preview-profile-img" src="{{$profile['picture']['data']['url']}}" alt="">
            <div class="preview-profile-info">
                <p class="preview-name">{{$profile['name']}}</p>
                <p class="preview-recent">Vừa xong</p>
            </div>
        </div>
        <div class="preview-content">
            <p>{{$message}}</p>
            <a href="{{$link}}" target="_blank">{{$link}}</a>
        </div>
        <div class="preview-interact">
            <button class="btn-interact like"><i class="fa fa-send icon"></i>  Thích</button>
            <button class="btn-interact comment"><i class="fa fa-comment icon"></i>  Bình luận</button>
            <button class="btn-interact share"><i class="fa fa-share icon"></i>  Chia sẻ</button>
        </div>
