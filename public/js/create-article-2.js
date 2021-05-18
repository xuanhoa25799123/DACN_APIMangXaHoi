$(document).ready(function() {
    $('.image-input').on('change',function(e) {
        console.log("asds");
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
    $('.submit-button').on('click',function(){
        let title = $('input[name=title]').val();
        let description = $('textarea[name=description]').val();
        let author = $('input[name=author]').val();
        let content = $('textarea[name=content]').val();
        let photo_url = $('input[name=photo_url]').val();
        console.log(title,description,author,content,photo_url)
        if($.trim(title)==""||$.trim(description)==""||$.trim(content)==""||$.trim(photo_url)=="")
        {
             Swal.fire({ 
                    title: 'Vui lòng điền vào các trường bắt buộc',
                    icon: 'info',
                    confirmButtonColor: '#3085d6',
                })
                return;
        }
        else{
            let url = $(this).data('href');
                    $.ajax({
            url: url,
            type: 'POST',
            data:{
                title,description,author,content,photo_url
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if(response.message=="Success")
                {
                Swal.fire({
                    title: 'Thành công',
                    text: "Đã đăng bài viết",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c800b',
                    confirmButtonText:"OK",
                    cancelButtonText:"Ở lại",
                }).then(result=>{
                    if(result.isConfirmed)
                    {
                        window.location.href="/oa/article";
                    }
                })
            }
            else{
                Swal.fire({
                    title: 'Bài viết chưa được đăng',
                    text: response.message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                })
            }
            }
        });
        }

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