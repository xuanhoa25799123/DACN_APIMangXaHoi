$(document).ready(function() {
    $('.cover-photo').on('change',function(e) {
        const image = e.target.files[0];
        var pattern = /image-*/;
        if (!image.type.match(pattern)) {
            SetValidate('Chỉ nhận file ảnh');
            return;
        }
        let reader = new FileReader();
        $("#cover-image").css('display','initial');
         let imgtag = document.getElementById('cover-image');
        reader.onload=function(e)
        {
             imgtag.src = e.target.result;
        }
             reader.readAsDataURL(image);
    });
});