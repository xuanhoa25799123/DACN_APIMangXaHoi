<div class="sidebar">
    <div class="logo">
        <img class="logo-img" src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/cd/Zalo_logo_2019.svg/1024px-Zalo_logo_2019.svg.png">
    </div>
    <div class="sidebar-content">
    <div class="api-socials">Zalo doanh nghiệp</div>
        <div class="item-container">
        <a class="social-item" href="{{route('oa-list')}}">Danh sách người quan tâm</a>
            <a class="social-item" href="{{route('oa-dashboard')}}">
                <img clas="logo" src="{{$oa_info['avatar']}}">
                {{$oa_info['name']}}</a>
    </div>
</div>
</div>
