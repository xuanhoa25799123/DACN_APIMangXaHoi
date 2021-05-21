
$(document).ready(function() {
 let selected_video_id = null;
    $('.video-popup-item').on('click',function(){
        $('.video-popup-item').removeClass("active-video");
        let id = $(this).data('id');
        selected_video_id = id;
        $(`.image-${id}`).addClass("active-video");
        $('.select-video').css('display','initial');
    })
        $('.select-video').on('click',function(){
        let image_src = $(`.image-${selected_video_id}`).attr('src');
        $('.sub-video-info').css('display','none');
        $('.video-preview').css('display','flex');
        $('.preview-video').attr('src',image_src);
    })
});