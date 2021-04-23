$(document).ready(function() {
    $('.post-status-link').on('change',function(){
        let link = $('input[name=link]').val();
        console.log('change');
        $.ajax({
            url: '/preview-url',
            type: 'POST',
            data:{
                link
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (response) {
                let data =response.data;
                var preview = '<a class="send-preview-link" href="'+data.url+'"target="_blank"><img class="send-preview-img" src="'+data.image+'">'+
                    '<div class="send-preview-text"><p class="send-preview-title">' +data.title+
                    '</p><p class="send-preview-description">' +data.description+
                    '</p><p class="send-preview-host">' +data.host+
                    '</p></div>';
                $('.results').html(preview);
            },
        })
    })
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

