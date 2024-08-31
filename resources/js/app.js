import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    const toastSuccessElement = document.getElementById("success");
    if (toastSuccessElement) {
        setTimeout(function () {
            toastSuccessElement.remove();
        }, 5000);
    }
    const toastDangerElement = document.getElementById("danger");
    if (toastDangerElement) {
        setTimeout(function () {
            toastDangerElement.remove();
        }, 5000);
    }

    // const allBtnSubmit = document.querySelectorAll('button[type="submit"]');
    // allBtnSubmit.forEach(btn => {
    //     btn.addEventListener("click", function (e) {
    //         this.setAttribute('disabled', 'disabled');
    //         this.form.submit();
    //     })
    // })
});
