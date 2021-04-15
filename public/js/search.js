$(document).ready(function() {
    $('#search-bar').change(function() {
        var keyword = $(this).val();
        console.log(keyword);
        $.ajax({
            url: '/dashboard/friend-list',
            type: 'POST',
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
