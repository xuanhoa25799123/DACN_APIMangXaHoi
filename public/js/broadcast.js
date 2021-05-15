 $(document).ready(function() {
     let selected_broadcast = [];
           $('input[name="daterange"]').daterangepicker({
         format: 'dd/mm/yyyy',
  }, function(start, end, label) {
      let st = start.format('DD-MM-YYYY');
      let en = end.format('DD-MM-YYYY');
        $.ajax({
            url: '/oa/broadcast/search-date',
            type: 'POST',
            data:{st,en},
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                 $('.cancel-daterange').css('display','initial');
              $('.article-rows').html(response.html);
            },
            error:function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
  });
   $('.cancel-daterange').on('click',function(){
        $.ajax({
            url: '/oa/reset-broadcast-date',
            type: 'get',
            dataType: 'json',
            success: function(response) {
            console.log(response.html);
               $('.cancel-daterange').css('display','none');
              $('.article-rows').html(response.html);
            },
              error:function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus); alert("Error: " + errorThrown);
            }
        });
  })
    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
      $.ajax({
            url: '/oa/reset-broadcast-date',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                 $('.cancel-daterange').css('display','none');
                console.log(response);
              $('.article-rows').html(response.html);
            },
              error:function(XMLHttpRequest, textStatus, errorThrown) {
                 alert("Error: " + errorThrown);
            }
        });
  });
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
    $('.select-broadcast').live('click',function(){
        let id =  $(this).data("id");
        console.log("asdasdsad");
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
