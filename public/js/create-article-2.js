$(document).ready(function() {
    $('.image-input').on('change',function(e) {
        let src = $(this).val();
        if(src=="")
        {
              $('.sub-image-info').css('display','flex');
              $('.image-preview').css('display','none');
        }
        else{
        $('.sub-image-info').css('display','none'); 
        $('.preview-image').attr('src',src);
        $('.image-preview').css('display','initial');
        }
    });   
    $('.video-button').on('click',function(){
        $(this).addClass('active-button');
        $('.image-button').removeClass('active-button');
        $('.video-content').css('display','flex');
        $('.image-content').css('display','none');
    })
     $('.image-button').on('click',function(){
        $(this).addClass('active-button');
        $('.video-button').removeClass('active-button');
        $('.image-content').css('display','flex');
        $('.video-content').css('display','none');
    })
    $('.video-info').on('click',function(){
        $('.video-popup').css('display','flex');
        // $.ajax({
        //     url: "https://openapi.zalo.me/v2.0/article/getslice",
        //     type: 'POST',
        //     data:{
        //         link,message
        //     },
        //     headers:{
        //         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        //     },
        //     dataType: 'json',
        //     success: function(response) {
        //         Swal.fire({
        //             title: 'Thành công',
        //             text: "Đã đăng bài viết "+response.message + " "+response.link,
        //             icon: 'success',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#6c800b',
        //             confirmButtonText:"Trở về trang chủ",
        //             cancelButtonText:"Ở lại",
        //         }).then(result=>{
        //             if(result.isConfirmed)
        //             {
        //                 window.location.href="/dashboard";
        //             }
        //             else
        //             {
        //                 $(".preview-container").css('display','none');
        //             }
        //         })
        //     }
        // });
        
    })
    $('.close-video-popup').on('click',function(){
        $('.video-popup').css('display','none');
    })
});