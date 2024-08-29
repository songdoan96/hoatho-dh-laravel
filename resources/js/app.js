import "./bootstrap";
document.addEventListener("DOMContentLoaded", function () {
    const toastElement = document.getElementById("toast");
    if (toastElement) {
        setTimeout(function () {
            toastElement.remove();
        }, 5000);
    }
});
