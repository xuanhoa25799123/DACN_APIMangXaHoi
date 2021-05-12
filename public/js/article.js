$(document).ready(function() {
     $('#article-search').on('keyup',function() {
        var keyword = $(this).val();
        if(keyword=="")
        {
            keyword="*";
        }
        $.ajax({
            url: '/oa/article/'+keyword,
            type: 'get',
            dataType: 'json',
            success: function(response) {
                console.log(response.html);
                // $('.article-rows').html(response.html);
            }
        });
    });
    
       $('.article-delete').on('click',function() {
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
                            $(`#row-${id}`).remove();
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
    
});