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

const A = async () => {
    await axios('http://localhost/modules/api/user/firstView.php').then((res) => {

        res.data.forEach(elem => {
            console.log(elem);
        });
        // console.log(res.data);
        // console.log(res.data[0]['name']);
        // console.log(res.data[1]);
        // console.log(res.data[2]);
    });
};
const changingColor = (newColor) => {
    const specifiedChangingColor = () => {
        let new_color = document.getElementById(newColor.id);
        new_color.classList.toggle('changing_color');
    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            specifiedChangingColor();
        };
        // window.onload = A(i);

    };
}

window.onload = A();