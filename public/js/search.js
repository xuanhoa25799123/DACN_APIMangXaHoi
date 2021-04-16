$(document).ready(function() {
    $('#search-bar').change(function() {
        var keyword = $(this).val();
        console.log(keyword);
        $.ajax({
            url: '/dashboard/friend-list/'+keyword,
            type: 'get',
            dataType: 'html',
            success: function(response) {
                console.log(response.friends);
                $('.list-friends').html(response.html);
            }
        });
    });
});
