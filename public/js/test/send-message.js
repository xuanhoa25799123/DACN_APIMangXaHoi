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
                            confirmButtonText:"Dồng ý",
                        })
        }
        else{
            $.ajax({
                url: "http://localhost:8000/test/message-preview",
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
});



// let link = $('input[name=link]').val();
// let message=  $('textarea[name=message]').val();
// let url = $(this).data('href');
// $.ajax({
//     url: url,
//     type: 'POST',
//     data:{
//       link,message
//     },
//     headers:{
//         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
//     },
//     dataType: 'json',
//     success: function(response) {
//         Swal.fire({
//             title: 'Thành công',
//             text: "Đã gửi tin nhắn đến bạn bè",
//             icon: 'success',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText:"Quay lại",
//             cancelButtonText:"Ở lại",
//         }).then((result)=>{
//             if(result.isConfirmed)
//             {
//                 window.location.href="http://localhost:8000/test/friend-list";
//             }
//
//         })
//     }
// });
