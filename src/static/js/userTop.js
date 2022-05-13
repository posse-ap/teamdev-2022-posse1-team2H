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
const A = async () => {
    await axios('http://localhost/modules/api/user/firstView.php').then((res) => {

        res.data.forEach(elem => {
            let eachId = elem['id'];
            // console.log(elem['id']);
            idArray.push(eachId);
        });
        // console.log(idArray);
    });
};
let newIdArray = [];
const changingColor = (newColor) => {
    const specifiedChangingColor = (new_color,i) => {
        let new_color_id = document.getElementById(new_color);
        if(new_color_id.className=='star'+[i]+''){
            new_color_id.classList.add('changing_color');
            if (slicedArray) {
                slicedArray.push(idArray[i]);
                Cookies.set('ids', `${slicedArray}`, { expires: 1 });
                console.log(Cookies.get());
            } else {
                newIdArray.push(idArray[i]);
                Cookies.remove('ids');
                Cookies.set('ids', `${newIdArray}`, { expires: 1 });
                console.log(Cookies.get());
            }

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
            specifiedChangingColor(newColor.id,i);
        };

    };

}

let displayedData = [];
const savingData = () => {
    console.log(Cookies.get());
    // console.log(Cookies.get('NAMEを入れて下さい'));
    // 例↓
    console.log(Cookies.get('id0'));
}


window.onload = A();
