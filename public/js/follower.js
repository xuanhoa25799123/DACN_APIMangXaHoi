$(document).ready(function() {
     $('#follower-search').on('keyup',function() {
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/oa/list/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $('.follower-rows').html(response.html);
            }
        });
    });
    
});