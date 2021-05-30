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
            let url = $(this).data("href");
            $.ajax({
                url: url,
                type: "POST",
                data: { video: file },
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                processData: false,
                success: function (response) {
                    if (response.message == "Success") {
                        console.log(response.result);
                    }
                },
            });
        }
    });
});
