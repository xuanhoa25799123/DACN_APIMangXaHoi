$(document).ready(function() {
    $('#upload-image').on('change',function(e) {
        const image = e.target.files[0];
        var pattern = /image-*/;
        if (!image.type.match(pattern)) {
            SetValidate('Chỉ nhận file ảnh');
            return;
        }
        let reader = new FileReader();
        $("#cover-image").css('display','initial');
            $(".image-info").css('display','none');
        $('.cover-image').addClass("hasImg");
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
         $(".video-info").css('display','none');
          }
    });
    $('.submit-button').on('click',function(e) {
         let title = $("#title").val();
         let description = $("#description").val();
         let video = $('#upload-video').prop('files');
        video = video[0];
        let formData = new FormData();
        formData.append('file',video);
            let cover = $('#upload-image').prop('files');
                //  console.log(title,description,cover[0],video[0]);
         let url = $(this).data('href');
            $.ajax({
            url: url,
            type: 'POST',
            data:formData,
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.result);
                Swal.fire({
                    title: 'Thành công',
                    text: "Đã đăng bài viết",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText:"abc",
                }).then(result=>{
           
                        window.location.href="/oa";
        
                })
            }
        });
    
      
    });
    
});