{{--<div class="header">--}}
{{--        <div class="profile"><img class="user-img" alt="" src="{{$oa_info['avatar']}}"><p class="profile-name">{{$oa_info['name']}}</p>--}}
{{--        @include('oa.partials.menu-dropdown')--}}
{{--        </div>--}}
{{--</div>--}}

<div class="header">
    <div class="profile">
        <img class="user-img" alt="" src="{{$oa_info['avatar']}}">
        <div class="online-dot"></div>
        @include('oa.partials.menu-dropdown')
    </div>
</div>
<div class="header-content">
    <h2 class="header-content-item">{{$title}}</h2>
    <div class="flex content-header-item">
        <a class="content" href="/admin">Home </a>
        <p> {{$title}}</p>
    </div>
</div>
