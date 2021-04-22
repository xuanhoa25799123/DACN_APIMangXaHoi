$(document).ready(function() {
    $('.send-btn').on('click',function(){
        if($('.preview-container').css('display')=='none')
        {
            let link = $('input[name=link]').val();
            let message=  $('textarea[name=message]').val();
            if(link.trim()=="" && message.trim()=="")
            {
                Swal.fire({
                    title: 'Xảy ra lỗi',
                    text: "Điền vào ít nhất 1 ô",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText:"Đồng ý",
                })
            }
            else{
                $.ajax({
                    url: "/status-preview",
                    type: 'POST',
                    data:{
                        link,message
                    },
                    headers:{
                        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'json',
                    success: function(response) {
                        $('.preview-sub-container').html(response.html);
                        $('.preview-container').css('display','flex');
                        $('.preview-container').css('flex-direction','column');
                        $('.preview-container').css('align-items','center');
                    }
                });
            }
        }
        else{
            $('.preview-container').css('display','none');
        }
    })
    $('.btn-post-status').on('click',function(){
        let link = $('input[name=link]').val();
        let message=  $('textarea[name=message]').val();
        $.ajax({
            url: "/post-status",
            type: 'POST',
            data:{
                link,message
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                Swal.fire({
                    title: 'Thành công',
                    text: "Đã đăng bài viết "+response.message + " "+response.link,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c800b',
                    confirmButtonText:"Trở về trang chủ",
                    cancelButtonText:"Ở lại",
                }).then(result=>{
                    if(result.isConfirmed)
                    {
                        window.location.href="/dashboard";
                    }
                    else
                    {
                        $(".preview-container").css('display','none');
                    }
                })
            }
        });
    })
});

