$(document).ready(function() {
    $('#search-bar').change(function() {
        var keyword = $(this).val();
        console.log(keyword);
        $.ajax({
            url: '/dashboard/friend-list/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.test);
                console.log(response.friends);

            }
        });
    });
});
