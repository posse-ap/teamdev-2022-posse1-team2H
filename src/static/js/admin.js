"use strict";
const select = () => {
    for (let i = 1; i < 6; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        if (checkbox.type !== 'checkbox') {
            checkbox.type = "checkbox";
        } else {
            checkbox.type = "hidden";
        }
    }
}

let today = [];
const time = () => {
    let getTime = new Date();
    let year = getTime.getFullYear();
    let month = getTime.getMonth() + 1;
    today.push(year);
    if (month < 10) {
        let num = month;
        let newMonth = ('00' + num).slice(-2);
        today.push(newMonth)
    } else {
        today.push(month)
    }
    let dateToday = today.join(',').replaceAll(',', '-')
    console.log(dateToday);
    document.getElementById('date_today').value = dateToday;

}

time();

// const deleting = () => {
//     for (let i = 1; i < 6; i++) {
//         let checkbox = document.getElementById(`checkbox${i}`);
//         checkbox.type = "checkbox";

//         // ここから先はお任せします。
//         if (checkbox.checked) {

//         } else {

//         }

//         checkbox.type = "hidden";
//     }
// }

