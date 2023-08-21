document.addEventListener("DOMContentLoaded", function() {
    var get_qr_button = document.getElementById("get_qr_button");
    var qr_code_result = document.getElementById("qr_code_result");
    var download_buttons = document.querySelectorAll(".download_buttons_block button");

    // Обработчик для создания QR-кода
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
});
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

//
//     // Add event listeners to download buttons
//     const downloadButtons = document.querySelectorAll('[data-format]');
//     downloadButtons.forEach(button => {
//         button.addEventListener('click', () => {
//             const format = button.getAttribute('data-format');
//
//             if (format === 'svg') {
//                 downloadQRCodeSVG();
//             } else {
//                 downloadQRCodeImage(format);
//             }
//         });
//     });
//
//     function downloadQRCodeSVG() {
//         const svgElement = document.getElementById('qr_code_result'); // ID of your SVG element
//
//         // Serialize the SVG DOM element to string
//         const svgData = new XMLSerializer().serializeToString(svgElement);
//
//         const blob = new Blob([svgData], { type: 'image/svg+xml' });
//         downloadBlob(blob, 'generated_qr.svg');
//     }
//
// // Rest of the code remains the same
//
//     function downloadQRCodeImage(format) {
//         const svgElement = document.getElementById('qr_code_result'); // ID of your SVG element
//         const svgData = new XMLSerializer().serializeToString(svgElement);
//
//         const canvas = document.createElement('canvas');
//         canvsg(canvas, svgData);
//         const imageData = canvas.toDataURL(`image/${format}`);
//
//         const blob = dataURItoBlob(imageData);
//         downloadBlob(blob, `generated_qr.${format}`);
//     }
//
//     function downloadBlob(blob, fileName) {
//         const a = document.createElement('a');
//         a.href = URL.createObjectURL(blob);
//         a.download = fileName;
//         a.click();
//
//         URL.revokeObjectURL(a.href);
//     }
//
//     function dataURItoBlob(dataURI) {
//         const byteString = atob(dataURI.split(',')[1]);
//         const mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
//         const ab = new ArrayBuffer(byteString.length);
//         const ia = new Uint8Array(ab);
//         for (let i = 0; i < byteString.length; i++) {
//             ia[i] = byteString.charCodeAt(i);
//         }
//         return new Blob([ab], { type: mimeString });
//     }
// });

