$(document).ready(function () {
    let selected_broadcast = [];
    let date = new Date();
    $('input[name="daterange"]').val("");
    $('input[name="daterange"]').attr("placeholder", "Lọc theo thời gian");
    $('input[name="daterange"]').daterangepicker({
        format: "dd/mm/yyyy",
        showDropdowns: true,
        maxDate: date,
        autoUpdateInput: false,
    });
    $('input[name="daterange"]').on(
        "apply.daterangepicker",
        function (ev, picker) {
            let st = picker.startDate.format("DD-MM-YYYY");
            let en = picker.endDate.format("DD-MM-YYYY");
            $(this).val(
                `${picker.startDate.format(
                    "DD/MM/YYYY"
                )} - ${picker.endDate.format("DD/MM/YYYY")}`
            );
            $.ajax({
                url: "/oa/broadcast/search-date",
                type: "POST",
                data: { st, en },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    $(".cancel-daterange").css("display", "initial");
                    $(".article-rows").html(response.article_html);
                    $(".video-rows").html(response.video_html);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                },
            });
        }
    );
    $(".cancel-daterange").on("click", function () {
        $('input[name="daterange"]').val("");
        $('input[name="daterange"]').attr("placeholder", "Lọc theo thời gian");
        $.ajax({
            url: "/oa/reset-broadcast-date",
            type: "get",
            dataType: "json",
            success: function (response) {
                $(".cancel-daterange").css("display", "none");
                $(".article-rows").html(response.article_html);
                $(".video-rows").html(response.video_html);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                alert("Status: " + textStatus);
                alert("Error: " + errorThrown);
            },
        });
    });
    $('input[name="daterange"]').on(
        "cancel.daterangepicker",
        function (ev, picker) {
            $('input[name="daterange"]').val("");
            $('input[name="daterange"]').attr(
                "placeholder",
                "Lọc theo thời gian"
            );
            $.ajax({
                url: "/oa/reset-broadcast-date",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    $(".cancel-daterange").css("display", "none");
                    console.log(response);
                    $(".article-rows").html(response.article_html);
                    $(".video-rows").html(response.video_html);
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    alert("Error: " + errorThrown);
                },
            });
        }
    );
    $("#broadcast-search").on("keyup", function () {
        var keyword = $(this).val();
        if (keyword == "") {
            keyword = "*";
        }
        $.ajax({
            url: "/oa/broadcast/search/" + keyword,
            type: "get",
            dataType: "json",
            success: function (response) {
                $(".article-rows").html(response.article_html);
                $(".video-rows").html(response.video_html);
            },
        });
    });
    $("body").on("click", ".select-broadcast", function () {
        let id = $(this).data("id");

        if ($(this).hasClass("selected")) {
            $(`.item-${id}`).remove();
            $.ajax({
                url: `/oa/unselect-broadcast/${id}`,
                type: "get",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // $(this).html("Chọn");
                        let index = selected_broadcast.indexOf(id);
                        if (index > -1) {
                            selected_broadcast.splice(index, 1);
                        }
                        // $(this).removeClass("selected");
                        $(".article-rows").html(response.article_html);
                        $(".video-rows").html(response.video_html);
                    }
                },
            });
        } else {
            if (selected_broadcast.length == 5) {
                SweetAlert("Chọn tối đa 5 nội dung trong 1 broadcast");
                return;
            }
            let thumb = $(this).data("thumb");
            let title = $(this).data("title");
            let html = `<div class="broadcast-item item-${id}">
                <button class="remove-item" data-id="${id}"><i class="fa fa-times remove-icon"></i></button>
                <input type="hidden" name="id[]" value="${id}">
                <img class="broadcast-image" src="${thumb}">
                <p class="broadcast-title">${title}</p>
                <div class="broadcast-more-info" style="width:80%"></div>
                <div class="broadcast-more-info" style="width:50%"></div>
                <div class="broadcast-more-info" style="width:20%"></div>
            </div>`;
            $(".broadcast-content").append(html);
            $.ajax({
                url: `/oa/select-broadcast/${id}`,
                type: "get",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        selected_broadcast.push(id);
                        $(".article-rows").html(response.article_html);
                        $(".video-rows").html(response.video_html);
                    }
                },
            });
        }
    });
    // $(".send-broadcast").on("click", function () {
    //     if (selected_broadcast.length < 1) {
    //         SweetAlert("Vui lòng chọn ít nhất 1 bài viết");
    //         return;
    //     }
    //     let id_str = selected_broadcast.join(",");
    //     window.location.href = `/oa/view-broadcast/${id_str}`;
    // });
    $(".recipient-button").on("click", function (e) {
        e.stopPropagation();
        $(".recipient-container").css("display", "flex");
    });
    $("body").click(function () {
        $(".recipient-container").fadeOut().css("display", "none");
    });
    $(".close-recipient").click(function (e) {
        $(".recipient-container").css("display", "none");
    });

    // Prevent events from getting pass .popup
    $(".recipient-container").click(function (e) {
        e.stopPropagation();
    });
    $(".checkbox-input").on("change", function (e) {
        if ($(this).is(":checked")) {
            let name = $(this).data("name");
            $(this).attr("name", `${name}[]`);
        } else {
            $(this).removeAttr("name");
        }
    });
    $("body").on("click", ".submit-button", function () {
        let age = [];
        $('input[name="age[]"]').map(function () {
            age.push($(this).val());
        });

        let gender = $("input[name=gender]").val();
        let platform = [];
        $('input[name="platform[]"]').map(function () {
            platform.push($(this).val());
        });
        let id = [];
        $('input[name="id[]"]').map(function () {
            id.push($(this).val());
        });
        if (age.length == 0) {
            SweetAlert("Vui lòng chọn ít nhất 1 bài viết");
            return;
        }
        if (age.length == 0) {
            SweetAlert("Vui lòng chọn ít nhất 1 độ tuổi");
            return;
        }
        if (platform.length == 0) {
            SweetAlert("Vui lòng chọn ít nhất 1 loại thiết bị");
            return;
        }
        let url = $(this).data("href");
        $.ajax({
            url: url,
            type: "POST",
            data: {
                id,
                age,
                gender,
                platform,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            dataType: "json",
            beforeSend: function () {
                Swal.fire({
                    title: "Đang gửi broadcast...",
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
                        text: "Đã gửi broadcast",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#6c800b",
                        confirmButtonText: "OK",
                        cancelButtonText: "Ở lại",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "/oa/broadcast";
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Broadcast chưa được gửi",
                        text: response.message,
                        icon: "warning",
                        confirmButtonColor: "#3085d6",
                    });
                }
            },
        });
    });
    $(".tab-article").on("click", function () {
        $(this).addClass("active-tab");
        $(".tab-video").removeClass("active-tab");
        $(".button-create-article").css("display", "initial");
        $(".button-create-video").css("display", "none");
        $(".total-article").css("display", "initial");
        $(".total-video").css("display", "none");
        $(".video-table").css("display", "none");
        $(".article-table").css("display", "initial");
    });
    $(".tab-video").on("click", function () {
        $(this).addClass("active-tab");
        $(".tab-article").removeClass("active-tab");
        $(".button-create-article").css("display", "none");
        $(".button-create-video").css("display", "initial");
        $(".total-article").css("display", "none");
        $(".total-video").css("display", "initial");
        $(".video-table").css("display", "initial");
        $(".article-table").css("display", "none");
    });
    $(".back-button").on("click", function () {
        window.history.go(-1);
    });
    $("body").on("click", ".remove-item", function () {
        let id = $(this).data("id");
        $(this).parent().remove();
        $(`.item-${id}`).remove();
        $.ajax({
            url: `/oa/unselect-broadcast/${id}`,
            type: "get",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    let index = selected_broadcast.indexOf(id);
                    if (index > -1) {
                        selected_broadcast.splice(index, 1);
                    }
                    $(".article-rows").html(response.article_html);
                    $(".video-rows").html(response.video_html);
                }
            },
        });
    });
});

let SweetAlert = (message) => {
    Swal.fire({
        title: "Lỗi",
        text: message,
        icon: "info",
    });
};
