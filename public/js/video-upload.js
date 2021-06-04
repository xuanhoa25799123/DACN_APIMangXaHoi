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
            let oa_token = $(this).data("oa_token");
            $.ajax({
                url:
                    "https://openapi.zalo.me/v2.0/article/upload_video/preparevideo?access_token=" +
                    accessToken,
                type: "POST",
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        console.log(response.result);
                    }
                },
            });
        }
    });
});
