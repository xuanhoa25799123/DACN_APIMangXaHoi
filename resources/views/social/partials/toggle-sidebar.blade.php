<button class="toggle-sidebar-button"><i class="fas fa-bars fa-1x"></i></button>
<div class="toggle-sidebar">
    <div class="toggle-sidebar-logo-container">
        <a class="toggle-sidebar-logo" href="/admin">
            <p class="toggle-sidebar-logo-text">Zalo API</p>
        </a>
    </div>
    <div class="toggle-sidebar-content">
        <p class="toggle-sidebar-content-header">Zalo xã hội</p>
        <a class="toggle-sidebar-item" href="/dashboard">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-home toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Trang chủ</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('friend-list')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-comments toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Gửi tin nhắn</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('invite-list')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-envelope-open toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Mời tham gia ứng dụng</p>
        </a>
        <a class="toggle-sidebar-item" href="{{route('make-status')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-pencil toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Tạo bài viết</p>
        </a>
        <p class="toggle-sidebar-content-header">Zalo doanh nghiệp</p>
        <a class="toggle-sidebar-item" href="{{route('oa-token')}}">
            <div class="toggle-sidebar-item-icon-container">
                <i class="fa fa-briefcase toggle-sidebar-item-icon"></i>
            </div>
            <p class='toggle-sidebar-item-text'>Chọn doanh nghiệp</p>
        </a>
    </div>

</div>
