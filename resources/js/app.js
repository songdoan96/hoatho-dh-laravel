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

    const btnShowOrder = document.querySelectorAll(".btn-show-order");
    btnShowOrder.forEach((btn) => {
        btn.addEventListener("click", function () {
            const ordersChild = document.querySelectorAll(
                ".order-child-" + this.dataset.id
            );
            if (btn.classList.contains("showing")) {
                btn.classList.remove("showing");
                ordersChild.forEach((element) => {
                    element.classList.add("hidden");
                });
            } else {
                btn.classList.add("showing");
                ordersChild.forEach((element) => {
                    element.classList.remove("hidden");
                });
            }
        });
    });
});
