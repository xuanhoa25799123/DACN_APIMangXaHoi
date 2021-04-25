<div class="sidebar">
    <div class="logo">
        <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Zalo_logo_2019.svg/1024px-Zalo_logo_2019.svg.png">
    </div>
    <div class="sidebar-content">
    <div class="api-socials">Zalo xã hội</div>
        <div class="item-container">
    <a class="social-item" href="{{route('friend-list')}}">Gửi tin nhắn</a>
    <a class="social-item" href="{{route('invite-list')}}">Mời tham gia ứng dụng</a>
            <a class="social-item" href="{{route('make-status')}}">Tạo bài viết</a>
    <a class="social-item" href="{{route('profile')}}">Thông tin cá nhân</a>
    <div class="social-item">
        <p>Token hết hạn vào <p id="expires-time">{{$expires}}</p> </p>
        <button class="btn btn-primary refresh-token-btn" data-href="{{route('refresh-token')}}"><i class="fa fa-refresh"></i> Làm mới Token</button>
    </div>
    </div>
</div>
</div>
