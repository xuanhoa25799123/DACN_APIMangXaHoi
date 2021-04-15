$(document).ready(function() {
    $('#search-bar').change(function() {
        var keyword = $(this).val();
        console.log(keyword);
        $.ajax({
            url: '/dashboard/friend-list/'+keyword,
            type: 'get',
            dataType: 'text',
            data : {
                keyword : keyword,
            },
            success: function(response) {
                $('.list-friends').html(response.html);
            }
        });
    });
});
