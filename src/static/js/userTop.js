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
    let agency_name_class = document.getElementsByClassName('star changing_color');
    for (var L = 0; L < agency_name_class.length; L++) {
        let agency_name_element = agency_name_class.item(L);
        let agency_name_id = agency_name_element.id;
        let agency_name = $('#' + [agency_name_id] + '').prev('').text();
        document.cookie = `agencName${L}=${agency_name};max-age=60`;
        var data = document.cookie.split(';');
        data.forEach(function (value) {
            let content = value.split('=');
            console.log(content[1]);
        })

    }
    displayingData(data);


}

const displayingData = (data) => {
    let cookies = data;
    cookies.shift();
    console.log(cookies);
}




