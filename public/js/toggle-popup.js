$(document).ready(function() {
    $('.toggle-popup').on('click',function(){
        console.log($('.popup-container').css('display'));
        if($('.popup-container').css('display')=='none')
        {
            $('.popup-container').css('display','flex');
            $('.popup-container').css('flex-direction','column');
            $('.popup-container').css('align-items','center');
        }
        else{
            $('.popup-container').css('display','none');
        }
    })
});
