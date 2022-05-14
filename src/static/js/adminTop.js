"use strict";
const select = () => {
    for (let i = 1; i < 7; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        new Promise(resolve => {
            checkingStatus(checkbox, i);
            resolve();
        }).then(() => {
            checkbox.type = "checkbox";
        })
    }
}

const checkingStatus = (checkbox, i) => {
    let label = document.getElementById(`label${i}`);
    if (label.textContent == '支払い済み') {
        checkbox.checked = true;
    } else {
        checkbox.checked = false;
    }
}

const edit = () => {
    for (let i = 1; i < 7; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        let label = document.getElementById(`label${i}`);
        new Promise(resolve => {
            checkingStatusSecondTime(checkbox, label);
            resolve();
        }).then(() => {
            checkbox.type = "hidden";
        })
    }
}

const checkingStatusSecondTime = (checkbox, label) => {
    if (checkbox.checked) {
        label.textContent = '支払い済み';
    } else {
        console.log('ryu');
        label.textContent = '未払い'
    }
}