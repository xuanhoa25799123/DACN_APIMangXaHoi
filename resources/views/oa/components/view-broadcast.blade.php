@extends('oa.layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{asset('/css/article.css')}}">
      <link rel="stylesheet" href="{{asset('/css/broadcast.css')}}">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="{{asset('/js/broadcast.js')}}"></script>
    <script src="{{asset('plugins/sweetalert2/sweetalert2@10.js')}}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
@endsection
@section('content')
    <div class="send-recipient">
    <button type="button" class="btn btn-outline-primary recipient-button">Chọn đối tượng gửi</button>
    <div class="recipient-container">
        <div class="recipient-header">
        <p class="bold">Chọn đối tượng gửi</p>
        <button type="button" class="recipient-close close-recipient">
            <i class="fa fa-close"></i>
        </button>
        </div>
        <p class="bold">Độ tuổi</p>
        <div class="form-group checkbox-container">
            <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]" type="checkbox" checked value="0"> 
              <p class="checkbox-label">Dưới 12 tuổi</p>
            </div>
             <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]" type="checkbox" checked value="1"> 
              <p class="checkbox-label">12-18 tuổi</p>
            </div>
             <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]" type="checkbox" checked value="2"> 
              <p class="checkbox-label">18-24 tuổi</p>
            </div>
             <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]"  type="checkbox" checked value="3"> 
              <p class="checkbox-label">25-34 tuổi</p>
            </div>
             <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]"  type="checkbox" checked value="4"> 
              <p class="checkbox-label">35-44 tuổi</p>
            </div>
            <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]"  type="checkbox" checked value="5"> 
              <p class="checkbox-label">45-45 tuổi</p>
            </div>
            <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]" type="checkbox" checked value="6"> 
              <p class="checkbox-label">55-64 tuổi</p>
            </div>
            <div class="checkbox-item">
                 <input class="checkbox-input" data-name="age" name="age[]" type="checkbox" checked value="7"> 
              <p class="checkbox-label">Trên 65 tuổi</p>
            </div>
        </div>
        <p class="bold">Giới tính</p>
        <div class="form-group checkbox-container">
              <div class="checkbox-item">
                 <input class="radio-input" name="gender" type="radio" checked value="0"> 
              <p class="checkbox-label">Tất cả</p>
            </div>
              <div class="checkbox-item">
                 <input class="radio-input"name="gender" type="radio" value="1"> 
              <p class="checkbox-label">Nam</p>
            </div>
             <div class="checkbox-item">
                 <input class="radio-input" name="gender" type="radio" value="2"> 
              <p class="checkbox-label">Nữ</p>
            </div>
        </div>
        <p class="bold">Nền tảng thiết bị</p>
         <div class="form-group checkbox-container">
            <div class="checkbox-item">
                 <input class="checkbox-input" data-name="platform" name="platform[]" type="checkbox" checked value="1"> 
              <p class="checkbox-label">IOS</p>
            </div>
            <div class="checkbox-item">
                 <input class="checkbox-input" data-name="platform" name="platform[]" type="checkbox" checked value="2"> 
              <p class="checkbox-label">Android</p>
            </div>
             <div class="checkbox-item">
                 <input class="checkbox-input" data-name="platform" name="platform[]" type="checkbox" checked value="3"> 
              <p class="checkbox-label">Thiết bị khác</p>
            </div>
    </div>
     <button type="button" class="btn btn-primary close-recipient">Xong</button>
    </div>
   
    </div>

    <div class="broadcast-content">
        @foreach($broadcast as $item)
            <div class="broadcast-item">
                <input type="hidden" name="id[]" value="{{$item->id}}">
                <img class="broadcast-image" src="{{$item->thumb}}">
                <p class="broadcast-title">{{$item->title}}</p>
                <div class="broadcast-more-info" style="width:80%"></div>
                <div class="broadcast-more-info" style="width:50%"></div>
                <div class="broadcast-more-info" style="width:20%"></div>
            </div>
        @endforeach
    </div>
    
    <button type="submit" class="btn btn-primary submit-button" data-href="{{route('oa-send-broadcast')}}">Gửi broadcast</button>

@endsection
