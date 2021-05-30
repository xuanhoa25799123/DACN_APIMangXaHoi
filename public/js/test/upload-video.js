$(document).ready(function () {
    $("#uploadFile").on("change", function (e) {
        let video = document.getElementById("uploadFile");
        console.log(video.files[0]);
    });
});
