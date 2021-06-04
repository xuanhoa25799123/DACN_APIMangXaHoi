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

    $(".submit-button").on("click", function () {
        let title = $("input[name=title]").val();
        let description = $("textarea[name=description]").val();
        let photo_url = $("input[name=photo_url]").val();
        let video_id = selected_video_id;
        let status = $("input[name=status]").is(":checked") ? "show" : "hide";
        let comment = $("input[name=comment]").is(":checked") ? "show" : "hide";
        if (
            $.trim(title) == "" ||
            $.trim(description) == "" ||
            $.trim(photo_url) == "" ||
            !video_id
        ) {
            Swal.fire({
                title: "Vui lòng điền vào các trường bắt buộc",
                icon: "info",
                confirmButtonColor: "#3085d6",
            });
            return;
        }
        let url = $(this).data("href");
        $.ajax({
            url: url,
            type: "POST",
            data: {
                title,
                description,
                avatar: photo_url,
                video_id,
                status,
                comment,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            beforeSend: function () {
                $(".loader-container").css("display", "flex");
            },
            success: function (response) {
                if (response.message == "Success") {
                    Swal.fire({
                        title: "Thành công",
                        text: "Đã đăng video",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6c800b",
                        confirmButtonText: "OK",
                        cancelButtonText: "Ở lại",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/oa/video";
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Video chưa được đăng",
                        text: response.message,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                    });
                }
            },
            complete: function () {
                $(".loader-container").css("display", "none");
            },
        });
    });
    $("body").on("click", ".video-popup-item", function () {
        if ($(this).hasClass("upload-item")) {
            $(".video-popup-image").removeClass("active-video");
            let id = $(this).data("id");
            temp_id = id;
            $(this).addClass("active-video");
            $(".select-video").css("display", "initial");
            select_upload = true;
        } else {
            $(".video-popup-image").removeClass("active-video");
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
            $(".sub-image-info").css("display", "none");
            $(".image-preview").css("display", "initial");
            $(".preview-image").attr("src", image_src);
            $(".image-input").val(image_src);
            $(".video-preview-icon").css("display", "none");
        }
    });
});
