$(document).ready(function() {
    $('.refresh-token-btn').on('click',function(){
        let url = $(this).data('href');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            headers:{
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
