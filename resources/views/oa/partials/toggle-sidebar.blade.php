{{--<div class="toggle-toggle-sidebar">--}}
{{--    <div class="logo">--}}
{{--        <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Zalo_logo_2019.svg/1024px-Zalo_logo_2019.svg.png">--}}
{{--    </div>--}}
{{--    <div class="toggle-toggle-sidebar-content">--}}
{{--    <div class="api-socials">Zalo doanh nghiệp</div>--}}
{{--        <div class="item-container">--}}
{{--        <a class="social-item" href="{{route('oa-list')}}">Danh sách người quan tâm</a>--}}
{{--            <a class="social-item" href="{{route('oa-dashboard')}}">--}}
{{--                <img class="oa-logo" src="{{$oa_info['avatar']}}">--}}
{{--                {{$oa_info['name']}}</a>--}}
{{--            <a class="social-item" href="{{route('oa-article')}}">Danh sách bài viết</a>--}}
{{--            <a class="social-item" href="{{route('oa-create-article')}}">Tạo bài viết mới</a>--}}
{{--    </div>--}}
{{--</div>--}}
{{--</div>--}}

<div class="toggle-toggle-sidebar">
    <div class="toggle-toggle-sidebar-logo-container">
        <a class="toggle-toggle-sidebar-logo" href="/admin">
            <p class="toggle-toggle-sidebar-logo-text">Zalo API</p>
        </a>
    </div>

    <div class="toggle-toggle-sidebar-content">
        <p class="toggle-toggle-sidebar-content-header">Zalo doanh nghiệp</p>
        <a class="toggle-toggle-sidebar-item" href="{{route('oa-home')}}">
            <div class="toggle-toggle-sidebar-item-icon-container">
                <i class="fa fa-home toggle-toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-toggle-sidebar-item-text'>Trang chủ</p>
        </a>
        <a class="toggle-toggle-sidebar-item" href="{{route('oa-broadcast')}}">
            <div class="toggle-toggle-sidebar-item-icon-container">
                <i class="fa fa-rss toggle-toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-toggle-sidebar-item-text'>Gửi broadcast</p>
        </a>
        <a class="toggle-toggle-sidebar-item" href="{{route('oa-list')}}">
            <div class="toggle-toggle-sidebar-item-icon-container">
                <i class="fa fa-users toggle-toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-toggle-sidebar-item-text'>Danh sách người quan tâm</p>
        </a>
        <a class="toggle-toggle-sidebar-item" href="{{route('oa-article')}}">
            <div class="toggle-toggle-sidebar-item-icon-container">
                <i class="fa fa-pencil toggle-toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-toggle-sidebar-item-text'>Danh sách bài viết</p>
        </a>
        <a class="toggle-toggle-sidebar-item" href="{{route('oa-video')}}">
            <div class="toggle-toggle-sidebar-item-icon-container">
                <i class="fa fa-video toggle-toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-toggle-sidebar-item-text'>Danh sách video</p>
        </a>

        <p class="toggle-toggle-sidebar-content-header">Zalo xã hội</p>
        <a class="toggle-toggle-sidebar-item" href="/dashboard">
            <div class="toggle-toggle-sidebar-item-icon-container">
                <i class="fa fa-arrow-left toggle-toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-toggle-sidebar-item-text'>Quay lại</p>
        </a>
    </div>

</div>
