$(document).ready(function() {
        let date = new Date();
            $('input[name="daterange"]').val("");
    $('input[name="daterange"]').attr("placeholder","Lọc theo thời gian");
      $('input[name="daterange"]').daterangepicker({
         format: 'dd/mm/yyyy',
          showDropdowns: true,
        maxDate:date,
        autoUpdateInput: false,
      });  
   $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        let st = picker.startDate.format('DD-MM-YYYY');
      let en = picker.endDate.format('DD-MM-YYYY');
      $(this).val(`${picker.startDate.format('DD/MM/YYYY')} - ${picker.endDate.format('DD/MM/YYYY')}`);
      $.ajax({
            url: '/oa/video/search-date',
            type: 'POST',
            data:{st,en},
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                 $('.cancel-daterange').css('display','initial');
              $('.video-rows').html(response.html);
            },     
        });
  });
  $('.cancel-daterange').on('click',function(){
       $('input[name="daterange"]').val("");
        $('input[name="daterange"]').attr("placeholder","Lọc theo thời gian");
        $.ajax({
            url: '/oa/reset-video-date',
            type: 'get',
            dataType: 'json',
            success: function(response) {
            console.log(response.html);
               $('.cancel-daterange').css('display','none');
              $('.video-rows').html(response.html);
            }, 
        });

  })
    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
         $('input[name="daterange"]').val("");
        $('input[name="daterange"]').attr("placeholder","Lọc theo thời gian");
      $.ajax({
            url: '/oa/reset-video-date',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                $('.cancel-daterange').css('display','none');
              $('.video-rows').html(response.html);
            }, 
        });
        
  });
     $('#video-search').on('keyup',function() {
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/oa/video/search/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                $('.video-rows').html(response.html);
            }
        });
    });
    
       $('body').on('click','.video-delete',function() {
           let id = $(this).data('id');
            let url = `/oa/delete-video/${id}`;
            Swal.fire({
                    title: 'Xoá bài viết',
                    text: "Bạn có chắc muốn xoá video",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#6c800b',
                    confirmButtonText:"Xoá bài viết",
                    cancelButtonText:"Huỷ",
                }).then(result=>{
                    if(result.isConfirmed)
                    {
                           $.ajax({
                         url: url,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            if(response.success)
                            {
                                 Swal.fire({
                                    title: 'Thành công',
                                    text: "Đã xoá bài viết",
                                    icon: 'success',
                   
                            })
                            $(`#row-${id}`).remove();
                            $('.total-video').html(response.total);
                            }
                            else{
                                    Swal.fire({
                                    title: 'Xảy ra lỗi',
                                    text: "Không thể xoá bài viết",
                                    icon: 'info',
                            })
                        }
                    }
        });
                    }
                })
      
    });

     $('.video-edit').on('click',function() {
           let id = $(this).data('id');
            let url = `/oa/edit-video/${id}`;
            window.location.href=url;
    });
});