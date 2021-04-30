<div class="sidebar">
    <div class="logo">
        <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Zalo_logo_2019.svg/1024px-Zalo_logo_2019.svg.png">
    </div>
    <div class="sidebar-content">
    <div class="api-socials">Zalo doanh nghiệp</div>
        <div class="item-container">
        <a class="social-item" href="{{route('oa-list')}}">Danh sách người quan tâm</a>
            <a class="social-item" href="{{route('oa-dashboard')}}">
                <img class="oa-logo" src="{{$oa_info['avatar']}}">
                {{$oa_info['name']}}</a>
            <a class="social-item" href="{{route('oa-article')}}">Danh sách bài viết</a>
            <a class="social-item" href="{{route('oa-create-article')}}">Tạo bài viết mới</a>
    </div>
</div>
</div>
