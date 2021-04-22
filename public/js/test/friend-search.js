$(document).ready(function() {
    $('#friend-search-bar').on('keyup',function() {
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/test/friend-list/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                $('.list-friends').html(response.html);
            }
        });
    });
});
// $(document).ready(function() {
//     $('.search-bar').keydown(function(event) {
//         if (event.keyCode == 13) {
//             var keyword = $(this).val();
//             $.ajax({
//             url: '/dashboard/friend-list/'+keyword,
//             type: 'get',
//             dataType: 'json',
//             success: function(response) {
//                 console.log(response.html);
//                 $('.list-friends').html(response.html);
//             }
//         });
//         }
//     });
//
// });


// $('.btn-post-status').on('click',function(){
//     let link = $('input[name=link]').val();
//     let message=  $('textarea[name=message]').val();
//     $.ajax({
//         url: "http://localhost:8000/test/post-status",
//         type: 'POST',
//         data:{
//             link,message
//         },
//         headers:{
//             'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
//         },
//         dataType: 'json',
//         success: function(response) {
//             Swal.fire({
//                 title: 'Thành công',
//                 text: "Đã đăng bài viết "+response.message + " "+response.link,
//                 icon: 'success',
//                 confirmButtonColor: '#3085d6',
//             })
//         }
//     });
// })
