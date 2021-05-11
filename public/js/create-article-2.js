$(document).ready(function() {
    $('.image-input').on('change',function(e) {
        let src = $(this).val();
        if(src=="")
        {
              $('.image-info').css('display','flex');

        }
        else{
        $('.image-info').css('display','none');
        $('.preview-image').attr('src',src);
        }
    });   
    $('.video-button').on('click',function(){
        $(this).addClass('active-button');
        $('.image-button').removeClass('active-button');
        $('.video-content').css('display','flex');
        $('.image-content').css('display','none');
    })
     $('.image-button').on('click',function(){
        $(this).addClass('active-button');
        $('.video-button').removeClass('active-button');
        $('.image-content').css('display','flex');
        $('.video-content').css('display','none');
    })
});