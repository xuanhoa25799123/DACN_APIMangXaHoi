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
            console.log(file);
            $.ajax({
                url: url,
                type: "POST",
                contentType: false,
                enctype: "multipart/form-data",
                processData: false,
                data: formData,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    "Access-Control-Allow-Headers":
                        "X-CSRF-Token, Content-Type",
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
