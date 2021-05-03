<div class="menu-dropdown">
    <div class="arrow-up"></div>
    <div class="menu-container">
        <div class="menu-header">
            <img src="{{$profile['picture']['data']['url']}}" class="user-img-2" alt="">
            <p>{{$profile['name']}}</p>
        </div>
        <a class="menu-item" href="{{route('profile')}}"><i class="fa fa-user icon"></i>Xem thông tin</a>
        <a class="menu-item" href="/"><i class="fa fa-power-off icon"></i>Đăng xuất</a>
    </div>
</div>
