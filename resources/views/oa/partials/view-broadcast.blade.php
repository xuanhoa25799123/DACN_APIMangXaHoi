<div class="broadcast-view-container" id="broadcast-123">
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

    </div>
              <div class="loader-container">
                <div class="loader"></div>
            </div>
    <button type="submit" class="btn btn-primary submit-button" data-href="{{route('oa-send-broadcast')}}">Gửi broadcast</button>
</div>