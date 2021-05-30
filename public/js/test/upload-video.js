$(document).ready(function () {
    $("#uploadFile").on("change", function (e) {
        let input = document.getElementById("uploadFile");
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
                $("#uploadFile").val(null);
                alert("Chọn file mp4");
                return;
            }
            if (file.size > 50000000) {
                $("#uploadFile").val(null);
                alert("Chọn file ít hơn 50 MB");
                return;
            }
            let url = $(this).data("href");
            var formData = new FormData();
            formData.append("file", file);
            formData.append("name", "file");
            formData.append("filename", file.name);
            console.log(file);
            let access_token =
                "AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S";
            $.ajax({
                url:
                    "https://openapi.zalo.me/v2.0/article/upload_video/preparevideo?access_token=" +
                    access_token,
                type: "POST",
                contentType: false,
                enctype: "multipart/form-data",
                processData: false,
                data: formData,
                crossDomain: true,

                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Access-Control-Allow-Origin": "http://localhost:8000",
                },
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
