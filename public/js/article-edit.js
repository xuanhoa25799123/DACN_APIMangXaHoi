$(document).ready(function() {
    $('.image-input').on('change',function(e) {
        let src = $(this).val();
        if(src=="")
        {
              $('.sub-image-info').css('display','flex');
              $('.image-preview').css('display','none');
        }
        else{
        $('.sub-image-info').css('display','none'); 
        $('.preview-image').attr('src',src);
        $('.image-preview').css('display','initial');
        }
    });   
});