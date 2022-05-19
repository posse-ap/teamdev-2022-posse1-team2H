"use strict";
const select = () => {
    for (let i = 1; i < 6; i++) {
        let checkbox = document.getElementById(`checkbox${i}`);
        checkbox.type = "checkbox";
    }
}

let today = [];
const time = () => {
    let getTime = new Date();
    let year = getTime.getFullYear();
    let month = getTime.getMonth() + 1;
    let date = getTime.getDate();
    today.push(year);
    if (month < 10) {
        let num = month;
        let newMonth = ('00' + num).slice(-2);
        today.push(newMonth)
    } else {
        today.push(month)
    }

    if (date < 10) {
        let num = date;
        let newDate = ('00' + num).slice(-2);
        today.push(newDate);
    } else {
        today.push(date);
    }
    let dateToday = today.join(',').replaceAll(',', '-')
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

