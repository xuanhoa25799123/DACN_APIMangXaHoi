$(document).ready(function() {
    $('#upload-photo').on('change',function(e) {
        console.log("asdasd");
        const image = e.target.files[0];
        var pattern = /image-*/;
        if (!image.type.match(pattern)) {
            SetValidate('Chỉ nhận file ảnh');
            return;
        }
        let reader = new FileReader();
        $("#cover-image").css('display','initial');
        $('.cover-photo').addClass("hasImg");
         let imgtag = document.getElementById('cover-image');
        reader.onload=function(e)
        {
             imgtag.src = e.target.result;
        }
             reader.readAsDataURL(image);
            
    });
      $('#upload-video').on('change',function(e) {
          let video = e.target.files[0];
          let size = video.size;
          if(size>62914560)
          {
              alert("file nhỏ hơn 60MB");
          }
          else{
         var $source = $('#video_here');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $source.parent()[0].load();
            $(".video-change").css("display","initial");
        $(".video-player").css("display","initial");
         $(".temp").css('display','none');
          }
    });
    $('.submit-button').on('click',function(e) {
         let title = $("#title").val();
         let link = $("#link").val();
         let input_video = document.getElementById("#upload-video");
         let video = input_video.files[0];
         let input_cover = document.getElementById("#upload-photo");
         let cover = input_cover.files[0];
         if(!title || !link || !video || cover)
         {
                 Swal.fire({
                    title: 'Thông tin',
                    text: "Điền vào tất cả các trường",
                    icon: 'info',
                  
                    confirmButtonColor: '#3085d6',
       
                    confirmButtonText:"OK",
                  
                })
         }
    });
    
});