"use strict";

const appearing = (appearing) => {
    document.getElementById(appearing).classList.toggle('appearing');
}

const appearSidebar = () => {
    appearing("serach_content");
};

const appearIndustryTypes = () => {
    appearing("business_type_items");
};

const appearTypes = () => {
    appearing("business_features");
};

const changingColor = (newColor) => {
    let new_color_class_name = newColor.className;
    // checkingColor(new_color_class_name);

    const specifiedChangingColor = () => {
        let new_color = document.getElementById(newColor.id);
        new_color.classList.toggle('changing_color');
    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            var new_color_id = `star${i}`;
            if (newColor.id == new_color_id) {
                specifiedChangingColor();
            }
        };

    };
}
// const savingData = (agency_name) => {
//     A();
//     // let agency_name= agency_element.textContent;
//     document.cookie = `agencyName=${agency_name};max-age=60`;
//     // document.cookie = `agencyName=+${encodeURIComponent(agency_name)};max-age=60`;
//     let data = document.cookie.split(';');
//     data.forEach(function (value) {
//         let content = value.split('=');
//         console.log(content[1]);
//     })

// }

// let agency_names = [];
// let agency_name = document.getElementsByClassName('agency_name');
// for (let j = 0; j < agency_name.length; j++) {
//     var R = agency_name.item(j).id;
//     agency_names.push(R);
// }
// console.log(agency_names);
let array = [
    { id: 'star0', class: 'agency_name0' },
    { id: 'star1', class: 'agency_name1' },
    { id: 'star2', class: 'agency_name2' },
    { id: 'star3', class: 'agency_name3' },
    { id: 'star4', class: 'agency_name4' },
    { id: 'star5', class: 'agency_name5' },
    { id: 'star6', class: 'agency_name6' },
    { id: 'star7', class: 'agency_name7' },
    { id: 'star8', class: 'agency_name8' },
    { id: 'star9', class: 'agency_name9' },
    { id: 'star10', class: 'agency_name10' },
    { id: 'star11', class: 'agency_name11' },

]

// console.log(array[0].id);


let x = [];
function savingData() {
    let A = document.getElementsByClassName('star changing_color');
    for (var L = 0; L < A.length; L++) {   
        let B = A.item(L);
        let C = B.id;
        x.push(C);
        // console.log(x);
       let string = x.toString();
        // console.log(string);
        let replaceing=string.replaceAll('star','');
        // console.log(replaceing);
        let new_array = replaceing.split(',');
        // console.log(new_array);
        if (x[L] == array[new_array[L]].id) {
            // console.log(string);
            let M = string.replaceAll('star','agency_name');
            // console.log(M);
            let U = M.split(',');
            console.log(U);
            let n=U.toString();
            console.log(n);
            // let g=n.replaceAll(''+n+'','document.getElementById('+U[L]+').textContent');
            // let g=n.replaceAll(''+n+'','document.getElementById(U[L]).textContent');
            let g=n.replaceAll(''+[n]+'','document.getElementById(U[L]).textContent');
            console.log(g);
            // agency_name.push('document.getElementById('+U[L]+').textContent'); 
            // console.log(agency_name);
            // for(let v=0; v<U; v++){
            //     document.cookie = 'agencyName'+[v]+'='+[]+';max-age=60';
                
            // }
            // // document.cookie = `agencyName=+${encodeURIComponent(agency_name)};max-age=60`;
            let data = document.cookie.split(';');
            data.forEach(function(value){
                let content = value.split('=');
                console.log(content[1]);
            })
            
        }
    }


}



