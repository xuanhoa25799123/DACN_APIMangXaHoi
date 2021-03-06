$(document).ready(function () {
    let first = true;
    var objDiv = document.getElementById("scroll-div");
    objDiv.scrollTop = objDiv.scrollHeight;
    $(".btn-send-message").on("click", function () {
        let message = $(".message-enter").val();
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
                    $(".message-enter").val("");
                    if (response.message == "Success") {
                        let date = null;
                        if (first) {
                            date = new Date();
                            let datehtml =
                                date.getHours() +
                                ":" +
                                date.getMinutes() +
                                ", " +
                                date.getDate() +
                                "/" +
                                (date.getMonth() + 1) +
                                "/" +
                                date.getFullYear();
                            date = `<div class="message-date">${datehtml}</div>`;
                        }
                        first = false;
                        let html =
                            date +
                            `<div class="message-right">
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
                            title: "Tin nh???n ch??a ???????c g???i",
                            text: response.message,
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                        });
                    }
                },
            });
        }
    });
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
                        $(".message-enter").val("");
                        if (response.message == "Success") {
                            let date = "";
                            if (first) {
                                date = new Date();
                                let datehtml =
                                    date.getHours() +
                                    ":" +
                                    date.getMinutes() +
                                    ", " +
                                    date.getDate() +
                                    "/" +
                                    (date.getMonth() + 1) +
                                    "/" +
                                    date.getFullYear();
                                date = `<div class="message-date">${datehtml}</div>`;
                            }
                            first = false;
                            let html =
                                date +
                                `<div class="message-right">
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
                                title: "Tin nh???n ch??a ???????c g???i",
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
