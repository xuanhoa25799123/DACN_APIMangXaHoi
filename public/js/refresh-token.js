$(document).ready(function() {
    $('.refresh-token-btn').on('click',function(){
        let url = $(this).data('href');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
               $('#expires-time').innerHTML(response.expires);
            },


        })
    })
});
