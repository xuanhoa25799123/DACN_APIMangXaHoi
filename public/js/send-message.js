$(document).ready(function() {
    $('.send-message-link').on('change',function(){
        let link = $('input[name=link]').val();
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
                '</p><p class="send-preview-description">' +data.description?(data.description.length>80?data.description.slice(0,77)+'...':data.description):""+
                    '</p><p class="send-preview-host">' +data.host+
                    '</p></div>';
                $('.results').html(preview);
            }
        });
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
                            confirmButtonText:"Dồng ý",
                        })
        }
        else{
            $.ajax({
                url: "/send-preview",
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
    $('.btn-send-message').on('click',function(){
        let link = $('input[name=link]').val();

        let message=  $('textarea[name=message]').val();
        let url =  $(this).data('href');
        console.log(url)
        $.ajax({
            url: url,
            type: 'POST',
            data:{
                link,message
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                console.log(response.result);
                Swal.fire({
                    title: 'Thành công',
                    text: "Đã gửi tin nhắn",
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


// if (match_url.test(link)) {
//     // $("#results").hide();
//     // $("#loading_indicator").show(); //show loading indicator image
//
//     var extracted_url = link.match(match_url)[0]; //extracted first url from text filed
//     $.ajax({
//         url: "/extract-process",
//         type: 'POST',
//         data:{
//             'url': extracted_url
//         },
//         headers:{
//             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: 'json',
//         success: function(response) {
//             let data =response.data;
//             let extracted_images = data.images;
//             let total_images = parseInt(data.images.length-1);
//             let img_arr_pos = total_images;
//             let inc_image="";
//             if(total_images>0){
//                 inc_image = '<div class="extracted_thumb" id="extracted_thumb"><img src="'+data.images[img_arr_pos]+'" width="100" height="100"></div>';
//                 console.log(data.title,data.content,data.images[img_arr_pos]);
//             }else{
//                 inc_image ='';
//             }
//             console.log(data.title,data.content,data.images[img_arr_pos]);
//         }
//     });
