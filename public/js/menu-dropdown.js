$(document).ready(function() {
    $('.profile').on('click',function(){
        if($('.menu-dropdown').css('display')=='none')
        {
                        $('.menu-dropdown').css('display','flex');
                        $('.menu-dropdown').css('flex-direction','column');
        }
        else{
            $('.menu-dropdown').css('display','none');
        }
    })
});

