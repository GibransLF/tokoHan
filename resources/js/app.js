import "./bootstrap";

import Alpine from "alpinejs";

import "flowbite";

import datePicker from "flowbite/dist/datepicker.js";

window.Alpine = Alpine;

Alpine.start();

//default img error
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("img").forEach((img) => {
        img.addEventListener("error", function handleError() {
            if (img.getAttribute("src") !== "/img/logo.png") {
                img.src = "/img/logo.png";
            } else {
                img.removeEventListener("error", handleError);
            }
        });
    });
});
