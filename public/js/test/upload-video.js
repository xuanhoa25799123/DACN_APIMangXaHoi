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
            var data = new FormData();

            $.ajax({
                url: url,
                type: "POST",
                contentType: "multipart/form-data",
                processData: false,
                data: {
                    title,
                    description,
                    avatar: photo_url,
                    video_id,
                    status,
                    comment,
                },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (response) {
                    if (response.message == "Success") {
                        Swal.fire({
                            title: "Thành công",
                            text: "Đã cập nhật video",
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
                            title: "Video chưa được cập nhật",
                            text: response.message,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                        });
                    }
                },
            });
            var fr = new FileReader();
            fr.onload = receivedText;

            fr.readAsDataURL(file);
        }
    });
});
