$(document).ready(function () {
    $(".btn-test").on("click", function () {
        let accessToken =
            "AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S";
        $.ajax({
            url:
                "https://openapi.zalo.me/v2.0/oa/message?access_token=" +
                accessToken,
            type: "POST",
            data: {
                message: { text: "abc" },
                recipient: { user_id: "4317772276792006663" },
            },
            dataType: "json",
            success: function (response) {
                console.log(response);
            },
        });
    });

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
            // formData.append("contents", file);
            // formData.append("name", "file");
            // formData.append("filename", file.name);
            formData.append("file", file);
            console.log(file);
            let accessToken =
                "AEma5D8bHXGgwoWNrY1F4o7cAnVSDpHNO_in2UbkAajamqyYtn5NIoMsDHYd85LdCP4p3yygK4nifKCmaor2DJocH4x3ArOuUwvCRTmxJMf2laewk0LEEmoELKAM0KmTDgj9Gi4CB0TNlZLXsWjK3o63HL2rEKOLA95qRwajPWWWucLXZLvc91l5Nrc53L4vBR0oLx5w4J0KpGTgcm0qFnkCEagp1mmTAwmLVxyv7Iy6XovF-40T2mNC3a_uL3iGHjm6MEv0CX5XyL1kspOg5tomB59rOix_Lp7LFK4S";
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
    $(".btn-sw").on("click", function () {
        Swal.fire({
            title: "Please Wait !",
            html: "data uploading", // add html attribute if you want or remove
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            },
            showConfirmButton: false,
        });
        setTimeout(() => {
            swal.close();
        }, 5000);
    });
});
