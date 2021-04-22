$(document).ready(function() {
    $('.invite-btn').on('click',function(){
        if($('.preview-container').css('display')=='none')
        {

            let message=  $('textarea[name=message]').val();
            if(message.trim()=="")
            {
                Swal.fire({
                    title: 'Xảy ra lỗi',
                    text: "Điền vào ô tin nhắn",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText:"Đồng ý",
                })
            }
            else{
                $.ajax({
                    url: "/invite-preview",
                    type: 'POST',
                    data:{
                        message
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
    $('.btn-send-invite').on('click',function(){
        let message=  $('textarea[name=message]').val();
        let url =  $(this).data('href');
        $.ajax({
            url: url,
            type: 'POST',
            data:{
                message
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if (response.complete) {
                    Swal.fire({
                        title: 'Thành công',
                        text: "Đã gửi lời mời cho "+response.count+" bạn bè",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c800b',
                        confirmButtonText: "Trở về trang chủ",
                        cancelButtonText: "Ở lại",
                    }).then(result => {
                        if (result.isConfirmed) {
                            window.location.href = "/dashboard";
                        } else {
                            $(".preview-container").css('display', 'none');
                        }
                    })
                }
                else if(response.complete==false)
                {
                    Swal.fire({
                        title: 'Thành công',
                        text: "Chưa gửi lời mời cho "+response.count+" bạn bè",
                        icon: 'success',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#6c800b',
                        confirmButtonText: "Trở về trang chủ",
                        cancelButtonText: "Huỷ",
                        showDenyButton: true,
                        denyButtonColor: '#ff1414',
                        denyButtonText: 'Gửi lại lời mời',
                    }).then(result => {
                        if (result.isConfirmed) {
                            window.location.href = "/dashboard";
                        } else if(result.isDenied) {
                            $('.preview-contain').css('display','none');
                            window.location.href = "/send-invite/"+response.unsend;
                        }
                        else{
                            $('.preview-contain').css('display','none');
                        }
                    })
                }
            }

        });
    })
});


// $('.invite-btn').on('click',function(){
//     let message=  $('textarea[name=message]').val();
//     console.log(message);
//     let url = $(this).data('href');
//     $.ajax({
//         url: url,
//         type: 'POST',
//         data:{
//             message
//         },
//         headers:{
//             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: 'json',
//         success: function(response) {
//             Swal.fire({
//                 title: 'Thành công',
//                 text: "Đã gửi lời mời đến bạn bè",
//                 icon: 'success',
//                 showCancelButton: true,
//                 confirmButtonColor: '#3085d6',
//                 cancelButtonColor: '#d33',
//                 confirmButtonText:"Quay lại",
//                 cancelButtonText:"Ở lại",
//             }).then((result)=>{
//                 if(result.isConfirmed)
//                 {
//                     window.location.href="http://localhost:8000/test/invite-list";
//                 }
//             })
//         }
//     });
// })
