"use strict";
const select = () => {
    for (let i = 1; i < 7; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        new Promise(resolve => {
            checkingStatus(checkbox,i);
            resolve();
        }).then(() => {
            checkbox.type = "checkbox";
        })
    }
}

const edit = () => {
    for (let i = 1; i < 7; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        checkbox.type = "hidden";
    }
}

const checkingStatus = (checkbox,i) => {
    console.log('kamo');
    let label = document.getElementById(`label${i}`);
    if (label.textContent == '支払い済み') {
        checkbox.checked = true;
    } else {
        checkbox.checked = false;
    }
}