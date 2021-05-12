$(document).ready(function() {
     $('#article-search').on('keyup',function() {
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/oa/article/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $('.article-rows').html(response.html);
            }
        });
    });
    
});