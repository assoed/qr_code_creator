
document.addEventListener("DOMContentLoaded", function() {
    var get_qr_button = document.getElementById("get_qr_button");
    var qr_code_result = document.getElementById("qr_code_result");

    get_qr_button.addEventListener("click", function(event) {
        event.preventDefault(); // Отменяем обычное поведение кнопки

        var form = document.getElementById("qr_code_creator_form");
        var formData = new FormData(form);

        // Отправляем AJAX-запрос на обработку формы
        fetch(form.action, {
            method: "POST",
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                // Отображаем результат в блоке
                qr_code_result.innerHTML = data.result;
            })

    });
});