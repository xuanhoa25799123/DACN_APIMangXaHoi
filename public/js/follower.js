$(document).ready(function () {
    $("#follower-search").on("keyup", function () {
        var keyword = $(this).val();
        if (keyword == "") {
            keyword = "*";
        }
        $.ajax({
            url: "/oa/list/" + keyword,
            type: "get",
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    $(".follower-rows").html(response.html);
                } else {
                    if (response.message == "Error") {
                        window.location.href = "/oa/get-token";
                    }
                }
            },
        });
    });
});
