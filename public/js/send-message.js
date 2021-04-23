$(document).ready(function() {
    $('.send-btn').on('click',function(){
        if($('.preview-container').css('display')=='none')
        {
        let link = $('input[name=link]').val();
            var match_url = /\b(https?):\/\/([\-A-Z0-9.]+)(\/[\-A-Z0-9+&@#\/%=~_|!:,.;]*)?(\?[A-Z0-9+&@#\/%=~_|!:,.;]*)?/i;

            //continue if matched url is found in text field
            if (match_url.test(link)) {
                // $("#results").hide();
                // $("#loading_indicator").show(); //show loading indicator image

                var extracted_url = link.match(match_url)[0]; //extracted first url from text filed
                //ajax request to be sent to extract-process.php
                $.post('extract-process.php',{'url': extracted_url}, function(data){
                    let extracted_images = data.images;
                    let total_images = parseInt(data.images.length-1);
                    let img_arr_pos = total_images;
                    let inc_image="";
                    if(total_images>0){
                         inc_image = '<div class="extracted_thumb" id="extracted_thumb"><img src="'+data.images[img_arr_pos]+'" width="100" height="100"></div>';
                        console.log(data.title,data.content,data.images[img_arr_pos]);
                    }else{
                         inc_image ='';
                    }
                    console.log(data.title,data.content,data.images[img_arr_pos]);
                    //content to be loaded in #results element
                    var content = '<div class="extracted_url">'+ inc_image +'<div class="extracted_content"><h4><a href="'+extracted_url+'" target="_blank">'+data.title+'</a></h4><p>'+data.content+'</p><div class="thumb_sel"><span class="prev_thumb" id="thumb_prev"> </span><span class="next_thumb" id="thumb_next"> </span> </div><span class="small_text" id="total_imgs">'+img_arr_pos+' of '+total_images+'</span><span class="small_text">  Choose a Thumbnail</span></div></div>';

                    //load results in the element
                    $("#results").html(content); //append received data into the element
                    $("#results").slideDown(); //show results with slide down effect
                    $("#loading_indicator").hide(); //hide loading indicator image
                },'json')
            };
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
