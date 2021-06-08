$(document).ready(function () {
    $(".send-btn").on("click", function () {
        if ($(".preview-container").css("display") == "none") {
            let link = $("input[name=link]").val();
            let message = $("textarea[name=message]").val();
            if (link.trim() == "" && message.trim() == "") {
                Swal.fire({
                    title: "Xảy ra lỗi",
                    text: "Điền vào ít nhất 1 ô",
                    icon: "warning",
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "Đồng ý",
                });
            } else {
                $.ajax({
                    url: "/status-preview",
                    type: "POST",
                    data: {
                        link,
                        message,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (response) {
                        $(".preview-sub-container").html(response.html);
                        $(".preview-container").css("display", "flex");
                        $(".preview-container").css("flex-direction", "column");
                        $(".preview-container").css("align-items", "center");
                        $.ajax({
                            url: "/preview-url",
                            type: "POST",
                            data: {
                                link,
                            },
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            dataType: "json",
                            beforeSend: function () {
                                $(".temp").addClass("loader");
                            },
                            success: function (response) {
                                let preview = "";
                                if ($.trim(link) != "") {
                                    let data = response.data;
                                    let url = data.url ? data.url : ".";
                                    let image = data.image
                                        ? data.image
                                        : "https://cdn2.iconfinder.com/data/icons/pittogrammi/142/95-512.png";
                                    let title = data.title
                                        ? data.title
                                        : "Không có tiêu đề";
                                    let description = data.description
                                        ? data.description
                                        : "Không có mô tả";
                                    let host = data.host
                                        ? data.host
                                        : "Không rõ trang web";
                                    preview =
                                        '<a class="send-preview-link" href="' +
                                        url +
                                        '"target="_blank"><img class="send-preview-img" src="' +
                                        image +
                                        '">' +
                                        '<div class="send-preview-text"><p class="send-preview-host">' +
                                        host +
                                        '</p><p class="send-preview-title">' +
                                        title +
                                        "</p></div>";
                                    $(".results").html(preview);
                                }
                            },
                            complete: function () {
                                $(".temp").removeClass("loader");
                            },
                        });
                    },
                });
            }
        } else {
            $(".preview-container").css("display", "none");
        }
    });
    $(".btn-post-status").on("click", function () {
        let link = $("input[name=link]").val();
        let message = $("textarea[name=message]").val();
        $.ajax({
            url: "/post-status",
            type: "POST",
            data: {
                link,
                message,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            success: function (response) {
                Swal.fire({
                    title: "Thành công",
                    text:
                        "Đã đăng bài viết " +
                        response.message +
                        " " +
                        response.link,
                    icon: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#6c800b",
                    confirmButtonText: "Trở về trang chủ",
                    cancelButtonText: "Ở lại",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/dashboard";
                    } else {
                        $(".preview-container").css("display", "none");
                    }
                });
            },
        });
    });
});
