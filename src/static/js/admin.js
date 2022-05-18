"use strict";
const select = () => {
    for (let i = 1; i < 6; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        checkbox.type = "checkbox";
    }
}

const deleting = () => {
    for (let i = 1; i < 6; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        checkbox.type = "checkbox";

        // ここから先はお任せします。
        if (checkbox.checked) {

        } else {

        }

        checkbox.type = "hidden";
    }
}