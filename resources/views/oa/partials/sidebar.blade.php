{{--<div class="sidebar">--}}
{{--    <div class="logo">--}}
{{--        <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Zalo_logo_2019.svg/1024px-Zalo_logo_2019.svg.png">--}}
{{--    </div>--}}
{{--    <div class="sidebar-content">--}}
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

<div class="sidebar">
    <div class="sidebar-logo-container">
        <a class="sidebar-logo" href="/admin">
            <p class="sidebar-logo-text">Zalo API</p>
        </a>
    </div>

    <div class="sidebar-content">
        <p class="sidebar-content-header">Zalo doanh nghiệp</p>
        <a class="sidebar-item" href="{{route('oa-home')}}">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-home sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Trang chủ</p>
        </a>
        <a class="sidebar-item" href="{{route('oa-list')}}">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-comments sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Danh sách người quan tâm</p>
        </a>
        <a class="sidebar-item" href="/oa/article">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-envelope-open sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Danh sách bài viết</p>
        </a>

        <p class="sidebar-content-header">Zalo xã hội</p>
        <a class="sidebar-item" href="/dashboard">
            <div class="sidebar-item-icon-container">
                <i class="fa fa-out sidebar-item-icon"></i>
            </div>
            <p class='sidebar-item-text'>Quay lại</p>
        </a>
    </div>

</div>
