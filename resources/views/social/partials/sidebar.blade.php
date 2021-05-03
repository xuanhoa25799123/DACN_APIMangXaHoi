{{--<div class="sidebar">--}}
{{--    <div class="logo">--}}
{{--        <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Zalo_logo_2019.svg/1024px-Zalo_logo_2019.svg.png">--}}
{{--    </div>--}}
{{--    <div class="sidebar-content">--}}
{{--    <div class="api-socials">Zalo xã hội</div>--}}
{{--        <div class="item-container">--}}
{{--    <a class="social-item" href="{{route('friend-list')}}">Gửi tin nhắn</a>--}}
{{--    <a class="social-item" href="{{route('invite-list')}}">Mời tham gia ứng dụng</a>--}}
{{--            <a class="social-item" href="{{route('make-status')}}">Tạo bài viết</a>--}}
{{--    <a class="social-item" href="{{route('profile')}}">Thông tin cá nhân</a>--}}
{{--    </div>--}}
{{--        <div class="api-oa">Zalo doanh nghiệp</div>--}}
{{--        <div class="item-container">--}}
{{--            <a class="social-item" href="{{route('oa-token')}}">Chọn doanh nghiệp</a>--}}
{{--        </div>--}}
{{--</div>--}}
{{--</div>--}}


<div class="sidebar">
    <div class="sidebar-logo-container">
        <a class="sidebar-logo" href="/admin">
            <p class="sidebar-logo-text">Zalo API</p>
        </a>
    </div>

    <div class="sidebar-content">
        <p class="sidebar-content-header">Zalo xã hội</p>
        <a class="sidebar-item" href="/dashboard">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-home sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Trang chủ</p>
        </a>
        <a class="sidebar-item" href="{{route('friend-list')}}">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-comments sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Gửi tin nhắn</p>
        </a>
        <a class="sidebar-item" href="{{route('invite-list')}}">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-envelope-open sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Mời tham gia ứng dụng</p>
        </a>
        <a class="sidebar-item" href="{{route('make-status')}}">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-edit sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Tạo bài viết</p>
        </a>
        <p class="sidebar-content-header">Zalo doanh nghiệp</p>
        <a class="sidebar-item" href="{{route('oa-token')}}">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-building sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Chọn doanh nghiệp</p>
        </a>
    </div>

</div>
