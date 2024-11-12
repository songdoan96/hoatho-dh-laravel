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

    // KCS Page show hide button
    const showBellBtn = document.querySelector("#isShow");
    if (showBellBtn) {
        showBellBtn.addEventListener("change", async (event) => {
            if (event.currentTarget.checked) {
                document.querySelector("#bell").classList.remove("hidden");
                const url =
                    "http://172.17.0.30:8888/bell/help/" + event.target.value;
                try {
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error(`Response status: ${response.status}`);
                    }

                    const list = await response.json();
                    list.forEach((l) => {
                        if (document.querySelector(`#${l.help}`)) {
                            document
                                .querySelector(`#${l.help}`)
                                .classList.add("bg-green-500");
                        }
                    });
                    const btnHelp = document.querySelectorAll(".btn-help");
                    btnHelp.forEach((btn) => {
                        btn.addEventListener("click", () => {
                            const help = btn.dataset.help;
                            const line = btn.dataset.line;
                            fetch("http://172.17.0.30:8888/bell/help", {
                                method: "POST",
                                body: JSON.stringify({
                                    line,
                                    help,
                                }),
                                headers: {
                                    "Content-type":
                                        "application/json; charset=UTF-8",
                                },
                            });
                            location.reload();
                        });
                    });
                } catch (error) {
                    console.error(error.message);
                }
            } else {
                document.querySelector("#bell").classList.add("hidden");
            }
        });
    }
});
