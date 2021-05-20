   <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Chọn Video</h4>
        </div>
        <div class="modal-body">
        <div class="video-popup-container">
          @foreach($videos as $video)
          <div class="video-popup-item" id="video-{{$video->id}}" data-id="{{$video->video_id}}">
            <img class="video-popup-image image-{{$video->id}}" src="{{$video->thumb}}" alt="">
          </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary select-video" data-dismiss="modal">Chọn video làm đại diện</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
        </div>
      </div>
      
    </div>
  </div>