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
            url: '/oa/article/search-date',
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
        });
  });
  $('.cancel-daterange').on('click',function(){
       $('input[name="daterange"]').val("");
        $('input[name="daterange"]').attr("placeholder","Lọc theo thời gian");
        $.ajax({
            url: '/oa/reset-article-date',
            type: 'get',
            dataType: 'json',
            success: function(response) {
            console.log(response.html);
               $('.cancel-daterange').css('display','none');
              $('.article-rows').html(response.html);
            }, 
        });
  })
    $('input[name="daterange"]').on('cancel.daterangepicker', function(ev, picker) {
         $('input[name="daterange"]').val("");
        $('input[name="daterange"]').attr("placeholder","Lọc theo thời gian");
      $.ajax({
            url: '/oa/reset-article-date',
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                 $('.cancel-daterange').css('display','none');
              $('.article-rows').html(response.html);
            }, 
        });
        
  });
     $('#article-search').on('keyup',function() {
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/oa/article/search/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                $('.article-rows').html(response.html);
            }
        });
    });
    
       $('body').on('click','.article-delete',function() {
           let id = $(this).data('id');
            let url = `/oa/delete-article/${id}`;
            Swal.fire({
                    title: 'Xoá bài viết',
                    text: "Bạn có chắc muốn xoá bài viết",
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
                            $('.total-article').html(response.total);
                            $(`#row-${id}`).remove();
                            }
                            else{
                                    Swal.fire({
                                    title: 'Xảy ra lỗi',
                                    text:  response.message,
                                    icon: 'info',
                            })
                        }
                    }
        });
                    }
                })
      
    });

     $('.article-edit').on('click',function() {
           let id = $(this).data('id');
            let url = `/oa/edit-article/${id}`;
            window.location.href=url;
    });
});