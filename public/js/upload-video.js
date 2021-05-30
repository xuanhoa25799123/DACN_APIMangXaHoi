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
            var ext = file.split(".").pop();
            if (ext !== "mp4") {
                alert("Chọn file mp4");
                return;
            }
            if (file.size > 50000000) {
                alert("Chọn file ít hơn 50 MB");
                return;
            }
        }
    });
});
