$(document).ready(function () {
    $(".message-enter").keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            let message = $(this).val();
            let user_id = $(this).data("id");
            let url = $(this).data("href");
            console.log(message, user_id, url);
            if ($.trim(message) == "") {
                return;
            } else {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        message,
                        user_id,
                    },
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    dataType: "json",
                    success: function (response) {
                        if (response.message == "Success") {
                        } else {
                            Swal.fire({
                                title: "Tin nhắn chưa được gửi",
                                text: response.message,
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                            });
                        }
                    },
                });
            }
        }
    });
});
