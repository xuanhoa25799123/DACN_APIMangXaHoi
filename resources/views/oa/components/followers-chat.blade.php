@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/follower-chat.css')}}">
    <link rel="stylesheet" href="{{asset('/css/paginate.css')}}">
        <!-- <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.css')}}"> -->
@endsection
@section('js')
    <script src="{{asset('/js/follower.js')}}"></script>
    <script src="{{asset('/js/follower-chat.js')}}"></script>
     <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
          <!-- <link rel="stylesheet" href="{{asset('/plugins/select2/select2.min.js')}}"> -->
@endsection
@section('content')
    <div class="chat-container">
    <div class="recent-message">
        <h4>Tin nhắn gần đây</h4>
        @foreach($recentMessages as $message)
        <a class="recent-item" href="{{route('follower-chat',['id'=>$message->user->user_id])}}">
            <div class="user-info">
            <div class="user-avatar">
                <img class="user-image" src="{{$message->user->avatar}}" href="">
            </div>
            <div class="message-info">
                <p class="username">{{$message->user->display_name}}</p>
                <p class="message">
                @if($message->to_id == $message->user->user_id)
                    <i class="fa fa-reply icon"></i>
                @endif
                 @if($message->type=="text")
                                    {{substr($message->message,0,20)}}
                          
                                    @elseif($message->type=="sticker")
                                  [Biểu cảm]
                    @endif
                </p>
            </div>
            </div>
            <p class="time">{{$message->time}}</p>
        </a>
        @endforeach
    </div>
    <div class="user-message">
        <div class="user-message-header">
            <div class="user-info">
            <div class="user-avatar">
                <img class="user-image" src="{{$user->avatar}}">
            </div>
            <p class="username2">{{$user->display_name}}</p>
            </div>
            </div>
            <div class="message-container" id="scroll-div">
                @foreach($userMessages as $message)
                    <div class="message-date">{{$message->time}}</div>
                    @if($message->src)
                    <div class="message-left">
                        <div class="message-item">
                            <div class="user-avatar" style="width:40px;height:40px">
                                <img class="user-image" src="{{$message->from_avatar}}">
                            </div>
                            <div class="message-item-info">
                                <p class="username">{{$message->from_display_name}}</p>
                                <div class="message-content-left">
                                @if($message->type=="text")
                                    <p>
                                    {{$message->message}}
                                    </p>
                                    @elseif($message->type=="sticker")
                                    <img src="https://api.zaloapp.com/{{substr($message->url,19,strlen($message->url)-19}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="message-right">
                      <div class="message-item">
                            <div class="message-item-info">
                                <p class="username">{{$message->from_display_name}}</p>
                                <div class="message-content-right">
                                      @if($message->type=="text")
                                    <p>
                                    {{$message->message}}
                                    </p>
                                    @elseif($message->type=="sticker")
                                    <img src="{{$message->url}}">
                                    @endif
                                </div>
                            </div>
                               <div class="user-avatar" style="width:40px;height:40px">
                                <img class="user-image" src="{{$message->from_avatar}}">
                            </div>
                        </div>
                    </div>
                    
  
                    @endif

                @endforeach
            </div>
            <div class="form-group send-message-container">
                <input data-img="{{$oa_info['avatar']}}" data-name="{{$oa_info['name']}}"data-id="{{$user->user_id}}" data-href="{{route('follower-send-message')}}"class="form-control message-enter" placeholder="Nhập nội dung tin nhắn...">
                <button class="btn-send-message" data-img="{{$oa_info['avatar']}}" data-name="{{$oa_info['name']}}"data-id="{{$user->user_id}}" data-href="{{route('follower-send-message')}}">GỬI</button>
            </div>
        
    </div>
    </div>
@endsection
