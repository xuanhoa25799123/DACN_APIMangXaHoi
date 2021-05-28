
<button class="toggle-sidebar-button"><i class="fas fa-bars fa-1x"></i></button>
<div class="toggle-sidebar">
    <div class="toggle-sidebar-logo-container">
        <a class="toggle-sidebar-logo" href="/admin">
            <p class="toggle-sidebar-logo-text">Zalo API</p>
        </a>
    </div>

    <div class="toggle-sidebar-content">
        <p class="toggle-sidebar-content-header">Zalo doanh nghiệp</p>
        <a class="toggle-sidebar-item" href="{{route('oa-home')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-home toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Trang chủ</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('oa-broadcast')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-rss toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Gửi broadcast</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('oa-list')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-users toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Danh sách người quan tâm</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('oa-article')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-pencil toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Danh sách bài viết</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('oa-video')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-video toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Danh sách video</p>
        </a>

        <p class="toggle-sidebar-content-header">Zalo xã hội</p>
        <a class="toggle-sidebar-item" href="/dashboard">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-arrow-left toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Quay lại</p>
        </a>
    </div>

</div>
