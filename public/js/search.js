$(document).ready(function() {
    $('#search_bar').change(function() {
        var keyword = $(this).val();
        console.log(keyword);
        $.ajax({
            url: 'dashboard/friend-list',
            method: 'post',
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
