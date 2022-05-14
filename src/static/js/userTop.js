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

let idArray = [];
const displayingData = async () => {
    await axios('http://localhost/modules/api/user/firstView.php').then((res) => {

        res.data.forEach(elem => {
            let eachId = elem['id'];
            idArray.push(eachId);
        });
    });
};
let newIdArray = [];
const changingColor = (newColor) => {
    const specifiedChangingColor = (new_color, i) => {
        let new_color_id = document.getElementById(new_color);
        if (new_color_id.className == 'star' + [i] + '') {
            new_color_id.classList.add('changing_color');
            newIdArray.push(idArray[i]);
            Cookies.set('ids', `${newIdArray}`, { expires: 1 });
            console.log(Cookies.get());
        } else {
            new_color_id.classList.remove('changing_color');
            Cookies.remove('ids');
            let slicedArray = newIdArray.slice(0, i);
            console.log(slicedArray);
            Cookies.set('ids', `${slicedArray}`, { expires: 1 });
            console.log(Cookies.get());
        }

    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            specifiedChangingColor(newColor.id, i);
        };

    };
}

let displayedData = [];
const savingData = () => {
    // console.log(Cookies.get());
    console.log(Cookies.get('ids'));

    for (let i = 0; i < 12; i++) {
        Cookies.remove('ids');
    }
}


window.onload = displayingData();

// Cookies.set('hoge',[1,2,3]);
// console.log(Cookies.get());
// console.log(Cookies.get('hoge'));