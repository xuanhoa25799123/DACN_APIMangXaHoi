
$(document).ready(function() {
    $('.filter-male').change(function(){
        if(this.checked)
        {
           $('.item-male').prop('checked',true);
            $('.item-female').prop('checked',false);
            $('.filter-female').prop('checked',false);
            $('.filter-all').prop('checked',false);
        }
        else{
            $('.item-male').prop('checked',false);
        }
    })
    $('.filter-female').change(function(){
        if(this.checked)
        {
            $('.item-female').prop('checked',true);
            $('.item-male').prop('checked',false);
            $('.filter-male').prop('checked',false);
            $('.filter-all').prop('checked',false);
        }
        else{
            $('.item-female').prop('checked',false);
        }
    })
    $('.filter-all').change(function(){
        if(this.checked)
        {
            $('.item-male').prop('checked',true);
            $('.item-female').prop('checked',true);
            $('.filter-female').prop('checked',false);
            $('.filter-male').prop('checked',false);
        }
        else{
            $('.item-male').prop('checked',false);
            $('.item-female').prop('checked',false);
        }
    })
    // $('.unselected').on('click',function()
    // {
    //     $('.item-male').prop('checked',false);
    //     $('.item-female').prop('checked',false);
    //     $('.filter-female').prop('checked',false);
    //     $('.filter-male').prop('checked',false);
    //     $('.filter-all').prop('checked',false);
    // })
    $('.exit').on('click',function()
    {
        $('.popup-container').css('display','none');
    })
    $('.friend-submit').on('click',function(){
        var arr = [];

        $('input:checkbox[name=selected]:checked').each(function(){
            arr.push($(this).val());
        })
        if(arr.length==0)
        {
            Swal.fire({
                title: 'Xảy ra lỗi',
                text: "Chọn ít nhất 1 người bạn để gửi tin nhắn",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
            })
        }
        else{
            let idStr = arr.join(',');
            window.location.href="/send-message/"+idStr;
        }
    })
    $('.invite-submit').on('click',function(){
        var arr = [];
        $('input:checkbox[name=selected]:checked').each(function(){
            arr.push($(this).val());
        })
        if(arr.length==0)
        {
            Swal.fire({
                title: 'Xảy ra lỗi',
                text: "Chọn ít nhất 1 người bạn để gửi lời mời",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
            })
        }
        else{
            let idStr = arr.join(',');
            console.log(idStr);
            window.location.href="/send-invite/"+idStr;
        }
    })
});
