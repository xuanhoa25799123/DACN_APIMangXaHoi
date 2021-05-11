$(document).ready(function() {
    $('.image-input').on('change',function(e) {
        let src = $(this).val();
        $('.image-info').css('display','none');
        $('.preview-image').attr('src',src);
    });   
    $('.video-button').on('click',function(){
        $(this).addClass('active-button');
        $('.image-button').removeClass('active-button');
        $('.image-info').css('display','none');
        $('.video-info').css('display','initial');
    })
     $('.image-button').on('click',function(){
        $(this).addClass('active-button');
        $('.video-button').removeClass('active-button');
        $('.image-info').css('display','initial');
        $('.video-info').css('display','none');
    })
});