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

const savingData = () => {
    let A = document.getElementsByClassName('star changing_color');
    for (var L = 0; L < A.length; L++) {
        let B = A.item(L);
        let C = B.id;
        console.log(C);
        let O = $('#' + [C] + '').prev('').text();
        console.log(O);
        document.cookie = `agencName${L}=${O};max-age=60`;
        let data = document.cookie.split(';');
        data.forEach(function (value) {
            let content = value.split('=');
            console.log(content[1]);
        })

    }


}



