$(document).ready(function () {
    var objDiv = document.getElementById("scroll-div");
    objDiv.scrollTop = objDiv.scrollHeight;
    $(".message-enter").keypress(function (e) {
        if (e.which == 13) {
            e.preventDefault();
            let message = $(this).val();
            let user_id = $(this).data("id");
            let url = $(this).data("href");
            let image = $(this).data("img");
            let name = $(this).data("name");
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
                            let html = `<div class="message-right">
                      <div class="message-item">
                            <div class="message-item-info">
                                <p class="username">${name}</p>
                                <div class="message-content-right">
                                    <p>
                                    ${message}
                                    </p>
                                </div>
                            </div>
                               <div class="user-avatar" style="width:40px;height:40px">
                                <img class="user-image" src="${image}">
                            </div>
                        </div>
                    </div>`;
                            $(".message-container").append(html);
                        } else {
                            Swal.fire({
                                title: "Tin nhắn chưa được gửi",
                                text: response.message,
                                icon: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#3085d6",
                            });
                        }
                        $(this).val("");
                    },
                });
            }
        }
    });
});
