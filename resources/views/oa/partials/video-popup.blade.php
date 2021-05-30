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
          <label for="inputVideo" class="inputVideo">
              <i class="fa fa-upload icon"></i>
              <p class="upload-text">Tải lên từ máy tính (tối đa 50 MB)</p>
          </label>
          <input type="file" id="inputVideo" name="inputVideo">
          @foreach($videos as $video)

          <div class="video-popup-item" style="cursor:pointer" id="video-{{$video->video_id}}" data-id="{{$video->video_id}}">
            <img class="video-popup-image image-{{$video->video_id}}" src="{{$video->thumb}}" alt="">
          </div>
          @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary select-video" data-dismiss="modal" style="display:none">Chọn video</button>
          <button type="button" class="btn btn-default cancel-select" data-dismiss="modal">Đóng</button>
        </div>
      </div>
      
    </div>
  </div>