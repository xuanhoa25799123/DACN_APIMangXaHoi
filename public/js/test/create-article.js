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
         let video = $('#upload-video').prop('files');
         console.log(video[0]);
        // console.log(input_video);
              let cover = $('#upload-photo').prop('files');
            //   console.log(cover[0]);
        //  let cover = input_cover.files[0];
         if(!video)
         {
              Swal.fire({
                    title: 'Thông tin',
                    text: "Chọn video",
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText:"OK",        
                })
         }
         video[0];
            let formData = new FormData();
            formData.append('video',video[0]);
         let url = $(this).data('href');
            $.ajax({
            url: url,
            type: 'POST',
            data:{video:video[0]},
              processData: false,
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.result);
                // Swal.fire({
                //     title: response.message,
                //     text: response.message,
                //     icon: 'success',
                
                //     confirmButtonColor: '#3085d6',
              
                //     confirmButtonText:"abc",
                  
                // })
            }
        });
    
      
    });
    
});