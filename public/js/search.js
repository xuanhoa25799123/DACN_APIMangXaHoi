$('.search-bar').on('keyup',function() {
    var keyword = $(this).val();
    $.ajax({
        url: '/friend-list/'+keyword,
        type: 'get',
        dataType: 'json',
        success: function(response) {
            $('.list-friends').html(response.html);
        },
    });
});
// $(document).ready(function() {
    // $('.search-bar').on('keyup',function() {
    //     var keyword = $(this).val();
    //     $.ajax({
    //         url: '/friend-list/'+keyword,
    //         type: 'get',
    //         dataType: 'json',
    //         success: function(response) {
    //             $('.list-friends').html(response.html);
    //         }
    //     });
    // });
// });
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
