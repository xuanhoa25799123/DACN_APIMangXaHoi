$(document).ready(function () {
    let selected_video_id = null;
    let temp_id = null;
    let select_upload = false;
    $(".image-input").on("change", function (e) {
        console.log("asds");
        let src = $(this).val();
        if (src == "") {
            $(".sub-image-info").css("display", "flex");
            $(".image-preview").css("display", "none");
        } else {
            $(".sub-image-info").css("display", "none");
            $(".preview-image").attr("src", src);
            $(".image-preview").css("display", "initial");
        }
    });
    $(".video-button").on("click", function () {
        $(this).addClass("active-button");
        $(".image-button").removeClass("active-button");
        $(".video-content").css("display", "flex");
        $(".image-content").css("display", "none");
    });
    $(".image-button").on("click", function () {
        $(this).addClass("active-button");
        $(".video-button").removeClass("active-button");
        $(".image-content").css("display", "flex");
        $(".video-content").css("display", "none");
    });
    $(".submit-button").on("click", function () {
        let cover = null;

        let title = $("input[name=title]").val();
        let description = $("textarea[name=description]").val();
        let author = $("input[name=author]").val();
        let content = $("textarea[name=content]").val();
        let photo_url = $("input[name=photo_url]").val();
        let status = $("input[name=status]").is(":checked") ? "show" : "hide";
        let comment = $("input[name=comment]").is(":checked") ? "show" : "hide";
        console.log(title, description, author, content, photo_url, status);
        if (
            $.trim(title) == "" ||
            $.trim(description) == "" ||
            $.trim(content) == ""
        ) {
            Swal.fire({
                title: "Lưu ý",
                text: "Vui lòng điền vào các trường bắt buộc",
                icon: "info",
                confirmButtonColor: "#3085d6",
            });
            return;
        }
        if ($(".image-button").hasClass("active-button")) {
            if ($.trim(photo_url) == "") {
                Swal.fire({
                    title: "Lưu ý",
                    text: "Vui lòng điền vào ảnh đại diện",
                    icon: "info",
                    confirmButtonColor: "#3085d6",
                });
                return;
            }
            cover = {
                cover_type: "photo",
                photo_url,
                status: "show",
            };
        } else {
            if (selected_video_id == null) {
                Swal.fire({
                    title: "Lưu ý",
                    text: "Vui lòng chọn video đại diện",
                    icon: "info",
                    confirmButtonColor: "#3085d6",
                });
                return;
            }
            cover = {
                cover_type: "video",
                cover_view: "horizontal",
                video_id: selected_video_id,
                status: "show",
            };
        }

        let url = $(this).data("href");
        $.ajax({
            url: url,
            type: "POST",
            data: {
                title,
                description,
                author,
                content,
                cover,
                status,
                comment,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    title: "Đang tạo bài viết...",
                    html: "Vui lòng chờ", // add html attribute if you want or remove
                    allowOutsideClick: false,
                    onBeforeOpen: () => {
                        Swal.showLoading();
                    },
                    showConfirmButton: false,
                });
            },

            success: function (response) {
                swal.close();
                if (response.message == "Success") {
                    Swal.fire({
                        title: "Thành công",
                        text: "Đã đăng bài viết",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6c800b",
                        confirmButtonText: "OK",
                        cancelButtonText: "Ở lại",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/oa/article";
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Bài viết chưa được đăng",
                        text: response.message,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                    });
                }
            },
        });
    });
    $(".video-info").on("click", function () {
        $(".video-popup").css("display", "flex");
        // $.ajax({
        //     url: "https://openapi.zalo.me/v2.0/article/getslice",
        //     type: 'POST',
        //     data:{
        //         link,message
        //     },
        //     headers:{
        //         'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
        //     },
        //     dataType: 'json',
        //     success: function(response) {
        //         Swal.fire({
        //             title: 'Thành công',
        //             text: "Đã đăng bài viết "+response.message + " "+response.link,
        //             icon: 'success',
        //             showCancelButton: true,
        //             confirmButtonColor: '#3085d6',
        //             cancelButtonColor: '#6c800b',
        //             confirmButtonText:"Trở về trang chủ",
        //             cancelButtonText:"Ở lại",
        //         }).then(result=>{
        //             if(result.isConfirmed)
        //             {
        //                 window.location.href="/dashboard";
        //             }
        //             else
        //             {
        //                 $(".preview-container").css('display','none');
        //             }
        //         })
        //     }
        // });
    });
    $(".close-video-popup").on("click", function () {
        $(".video-popup").css("display", "none");
    });
    //    $(".video-popup-item").on("click", function () {
    //        $(".active-video").removeClass("active-video");
    //        let id = $(this).data("id");
    //        temp_id = id;
    //        $(`.image-${id}`).addClass("active-video");
    //        $(".select-video").css("display", "initial");

    //    });
    $("body").on("click", ".video-popup-item", function () {
        if ($(this).hasClass("upload-item")) {
            $(".active-video").removeClass("active-video");
            let id = $(this).data("id");
            temp_id = id;
            $(this).addClass("active-video");
            $(".select-video").css("display", "initial");
            select_upload = true;
        } else {
            $(".active-video").removeClass("active-video");
            let id = $(this).data("id");
            temp_id = id;
            $(`.image-${id}`).addClass("active-video");
            $(".select-video").css("display", "initial");
            select_upload = false;
        }
    });

    $(".select-video").on("click", function () {
        selected_video_id = temp_id;
        if (select_upload) {
            $(".sub-video-info").css("display", "none");
            $(".video-preview").css("display", "flex");
            $(".preview-video").css("display", "none");
            $(".video-preview").css("background-color", "black");
            $(".video-preview-icon").css("display", "initial");
        } else {
            let image_src = $(`.image-${selected_video_id}`).attr("src");
            $(".sub-video-info").css("display", "none");
            $(".video-preview").css("display", "flex");
            $(".preview-video").css("display", "initial");
            $(".preview-video").attr("src", image_src);
            $(".video-preview-icon").css("display", "none");
        }
    });

    // $(".select-video").on("click", function () {
    //     selected_video_id = temp_id;
    //     let image_src = $(`.image-${selected_video_id}`).attr("src");
    //     $(".sub-video-info").css("display", "none");
    //     $(".video-preview").css("display", "flex");
    //     $(".preview-video").attr("src", image_src);
    // });
});
