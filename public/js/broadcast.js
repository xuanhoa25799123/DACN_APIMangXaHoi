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
            url: '/oa/broadcast/search/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                $('.article-rows').html(response.html);
            }
        });
    })
    $('body').on('click','.select-broadcast',function(){
        if(selected_broadcast.length==5)
        {
            SweetAlert("Chọn tối đa 5 bài viết");
            return;
        }
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
    $('body').on('click','.submit-button',function(){
        let age = [];
         $('input[name="age[]"]').map(function(){
            age.push($(this).val());
        });
        
        let gender =$('input[name=gender]').val();
        let platform = [];
         $('input[name="platform[]"]').map(function(){
            platform.push($this).val();
        });
        let id = [];
         $('input[name="id[]"]').map(function(){
            id.push($this).val();
        })
        console.log(age,gender,platform,id);
        if(!age)
        {
            SweetAlert("Vui lòng chọn ít nhất 1 độ tuổi");
            return;
        }
        if(!platform)
        {
            SweetAlert("Vui lòng chọn ít nhất 1 loại thiết bị");
            return;
        }
        if(!id)
        {
            SweetAlert("Vui lòng chọn ít nhất 1 bài viết");
            return;
        }
        let url = $(this).data('href');
                 $.ajax({
            url: url,
            type: 'POST',
            data:{
                id,age,gender,platform,
            },
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if(response.message=="Success")
                {
                Swal.fire({
                    title: 'Thành công',
                    text: "Đã gửi broadcast",
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c800b',
                    confirmButtonText:"OK",
                    cancelButtonText:"Ở lại",
                }).then(result=>{
                    if(result.isConfirmed)
                    {
                        window.location.href="/oa/broadcast";
                    }
                })
            }
            else{
                Swal.fire({
                    title: 'Bài viết chưa được gửi',
                    text: response.message,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                }).then(result=>{
                    if(result.confirmed)
                    {
                        window.location.href="/oa/broadcast";
                    }
                })
            }
            }
        });

    })


});

let SweetAlert = (message)=>{
    Swal.fire({
                    title: 'Lỗi',
                    text: message,
                    icon: 'info',
                })
}
