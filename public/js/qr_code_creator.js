

document.addEventListener("DOMContentLoaded", function() {
    var get_qr_button = document.getElementById("get_qr_button");
    var qr_code_result = document.getElementById("qr_code_result");
    var download_buttons = document.querySelectorAll(".download_buttons_block button");

    get_qr_button.addEventListener("click", function(event) {
        event.preventDefault();
        var form = document.getElementById("qr_code_creator_form");
        var formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                qr_code_result.innerHTML = data;
            });
    });

    download_buttons.forEach(button => {
        button.addEventListener("click", function() {
            var format = this.getAttribute("data-format");
            var qrData = qr_code_result.querySelector("img").getAttribute("src");

            // Создайте ссылку для скачивания с указанным форматом
            var link = document.createElement("a");
            link.href = qrData + "&format=" + format;
            link.download = "qr_code." + format;

            // Нажмите на ссылку, чтобы начать скачивание
            link.click();
        });
    });
});
