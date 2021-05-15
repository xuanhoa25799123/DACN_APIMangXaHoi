 $(document).ready(function() {
     let selected_broadcast = [];
 $('#broadcast-search').on('keyup',function() {
       
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/oa/broadcast/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                $('.article-rows').html(response.html);
            }
        });
    })
    $('.select-broadcast').on('click',function(){
        let id =  $(this).data("id");
        if($(this).hasClass("selected"))
        {
                $(this).html("Chọn");
                let index = selected_broadcast.indexOf(id);
                if(index>-1)
                {
                    selected_broadcast.splice(index,1);
                }
            $(this).removeClass("selected");
        
        }
        else{
            $(this).html("Huỷ chọn");
                selected_broadcast.push(id);
            $(this).addClass("selected");
        }
    
    });
    $('.send-broadcast').on('click',function(){
       if(selected_broadcast.length<1)
       {
            SweetAlert("Vui lòng chọn ít nhất 1 bài viết");
            return;
       }
       let id_str=  selected_broadcast.join(',');
       window.location.href=`/oa/view-broadcast/${id_str}`;
    })
    $('.recipient-button').on('click',function(e) {
          e.stopPropagation();
        $('.recipient-container').css('display','flex');
    })
    $("body").click(function(){
        $(".recipient-container").fadeOut().css("display",'none');
    });
     $(".close-recipient").click(function(e){
        $(".recipient-container").css("display",'none');
    });

// Prevent events from getting pass .popup
$(".recipient-container").click(function(e){
  e.stopPropagation();
});
    $(".checkbox-input").on('change',function(e){
        if($(this).is(':checked'))
        {
           let name = $(this).data('name');
           $(this).attr('name',`${name}[]`);
        }
        else{
            $(this).removeAttr('name')
        }
    });


});

let SweetAlert = (message)=>{
    Swal.fire({
                    title: 'Lỗi',
                    text: message,
                    icon: 'info',
                })
}