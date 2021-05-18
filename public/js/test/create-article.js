$(document).ready(function() {
    $('#upload-photo').on('change',function(e) {
      
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
          if(size>41943040)
          {
              alert("file nhỏ hơn 40MB");
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
              let cover = $('#upload-photo').prop('files');
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
         let text= "Asdasdas";
         
            let formData = new FormData();
            formData.append('video',video[0],video[0].name);
                    let accessToken = 'AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S';
         let url = $(this).data('href');
            $.ajax({
            url: url,
            type: 'POST',
            data:formData,
             headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            processData: false,  // tell jQuery not to process the data
             contentType: false, 
            dataType: 'json',
            success: function(response) {
                console.log(response);
                // if(response.success)
                // {
                // console.log(response.result);
                // }
                // else{
                //     console.log(response.message);
                // }
            }
        });
    
      
    });
    
});