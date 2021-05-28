$(document).ready(function () {
    $("body").on("click", ".toggle-sidebar-button", function (e) {
        e.stopPropagation();

        if ($(".toggle-sidebar").css("display") == "none") {
            $(".toggle-sidebar").css("display", "flex");
        } else {
            $(".toggle-sidebar").css("display", "none");
        }
    });
    $("body").click(function () {
        $(".toggle-sidebar").fadeOut().css("display", "none");
    });
});
