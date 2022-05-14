"use strict";
const select = () => {
    for (let i = 1; i < 6; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        checkbox.type="checkbox";
        // checkingStatus(i);
    }
}

const edit = () => {
    for (let i = 1; i < 6; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        checkbox.type = "hidden";
    }
}

// const checkingStatus = (i) => {
//     let checkbox = document.getElementById(`checkbox${i}`);
//     if(checkbox.textContent=='支払い済み'){
//         checkbox.checked=true;
//     }else{
//         checkbox.checked=false;
//     }
// }