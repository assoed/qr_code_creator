document.addEventListener("DOMContentLoaded", function() {
    const get_qr_button = document.getElementById("get_qr_button");
    const qr_code_result = document.getElementById("qr_code_result");
    generate_qr_automatically()

    // Обработчик для создания QR-кода
    get_qr_button.addEventListener("click", function(event) {
        event.preventDefault();
       const form = document.getElementById("qr_code_creator_form");
       const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            body: formData
        })
            .then(response => response.text())
            .then(data => {
                qr_code_result.innerHTML = data;
            });
    });
});

function generate_qr_automatically(){
    const qr_code_result = document.getElementById("qr_code_result");
    const qr_code_link = document.getElementById("qr_code_link").value;
    const form = document.getElementById("qr_code_creator_form");
    const formData = new FormData(form);
    formData.set('qr_code_link', qr_code_link);

    fetch(form.action,{
        method: "POST",
        body: formData
    })
        .then(response => response.text())
        .then(data =>{
            qr_code_result.innerHTML = data;
        })
}

function downloadConvertedFile(format) {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const svgElement = document.getElementById('qr_code_result').querySelector('svg');
    const svgData = new XMLSerializer().serializeToString(svgElement);

    // Make an Ajax request to the Laravel route
    fetch('/convert', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'X-CSRF-TOKEN': csrfToken // Include the CSRF token header
        },
        body: `format=${format}&svgData=${encodeURIComponent(svgData)}`
})
.then(response => response.blob())
        .then(blob => {
            // Trigger download using the Blob data
            const a = document.createElement('a');
            a.href = URL.createObjectURL(blob);
            a.download = `generated_qr.${format}`;
            a.click();

            // Clean up URL object
            URL.revokeObjectURL(a.href);
        });
}

