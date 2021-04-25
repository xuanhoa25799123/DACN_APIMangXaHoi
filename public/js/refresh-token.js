$(document).ready(function() {
    $('.refresh-token-btn').on('click',function(){
        let url = $(this).data('href');
        $.ajax({
            url: 'https://zalo-api-app.herokuapp.com/refresh-token',
            type: 'GET',
            dataType: 'jsonp',
            headers:{
                'Access-Control-Allow-Origin':'*',
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.expires);
               $('#expires-time').innerHTML(response.expires);
            },
            fail:function(response)
            {
                console.log(response.message);
            }


        })
    })
});
