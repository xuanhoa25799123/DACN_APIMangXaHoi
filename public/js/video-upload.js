$(document).ready(function () {
    $("#inputVideo").on("change", function (e) {
        let input = document.getElementById("inputVideo");
        if (!input) {
            alert("Um, couldn't find the fileinput element.");
        } else if (!input.files) {
            alert(
                "This browser doesn't seem to support the `files` property of file inputs."
            );
        } else if (!input.files[0]) {
            alert("Please select a file before clicking 'Load'");
        } else {
            var file = input.files[0];
            var ext = file.name.split(".").pop();
            if (ext !== "mp4") {
                $("#inputVideo").val(null);
                alert("Chọn file mp4");
                return;
            }
            if (file.size > 50000000) {
                $("#inputvideo").val(null);
                alert("Chọn file ít hơn 50 MB");
                return;
            }
            let formData = new FormData();
            formData.append("file", file);
            let accessToken = $(this).data("oa_token");
            $.ajax({
                url:
                    "https://openapi.zalo.me/v2.0/article/upload_video/preparevideo?access_token=" +
                    accessToken,
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: function () {
                    $(".upload-text").text("Đang tải video lên...");
                    $("#inputvideo").attr("disabled", "disabled");
                },
                success: function (response) {
                    if (response.message == "Success") {
                        let token = response.data.token;
                        $.ajax({
                            url:
                                "https://openapi.zalo.me/v2.0/article/upload_video/verify?access_token=" +
                                accessToken +
                                "&token=" +
                                token,
                            type: "GET",
                            success: function (response) {
                                if (response.message == "Success") {
                                    let video_id = response.data.video_id;
                                    let title = response.data.video_name;
                                    let convert_percent =
                                        response.data.convert_percent;
                                    $(".inputVideo").after(`
                                      
          <div class="video-popup-item" style="cursor:pointer" id="video-${video_id}" data-id="${video_id}">
                <i class="fa fa-video video-popup-icon"></i>
                <p class="video-popup-percent">${convert_percent}%</p>
            <div class="video-popup-info">
              
                <p class="video-popup-title">${title}</p>
            </div>
          </div>
                                      `);
                                } else {
                                    console.log(response.message);
                                    alert(
                                        "Xảy ra lỗi, vui lòng thử lại sau ít phút"
                                    );
                                    return;
                                }
                            },
                        });
                    } else {
                        console.log(response.message);
                        alert("Xảy ra lỗi, vui lòng thử lại sau ít phút");
                        return;
                    }
                },
                complete: function () {
                    $(".upload-text").text(
                        "Tải lên từ máy tính (tối đa 50 MB)"
                    );
                    $("inputvideo").removeAttr("disabled");
                },
            });
        }
    });
});
