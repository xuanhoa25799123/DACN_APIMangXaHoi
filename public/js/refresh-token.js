$(document).ready(function() {
    $('.refresh-token-btn').on('click',function(){
        $.ajax({
            url: 'https://zalo-api-app.herokuapp.com/refresh-token',
            type: 'GET',
            dataType: 'json',
            success: function (response) {
               $('#expires-time').innerHTML(response.expires);
            },


        })
    })
});
