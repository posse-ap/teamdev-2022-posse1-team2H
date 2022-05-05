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
    checkingColor(new_color_class_name);

    const specifiedChangingColor = () => {
        let new_color = document.getElementById(newColor.id);
        new_color.classList.toggle('chaning_color');
    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
        let new_color_id = `star${i}`;
        if (newColor.id == new_color_id) {
            specifiedChangingColor();
        }
    };

};
}

const checkingColor = (new_color_class_name) => {
    // 押した時の色で判別
    if (new_color_class_name !== 'star chaning_color') {
        console.log('青');
        
    } else {
        ;
    }
}

const A= (agency_element)=>{
    let agency_name= agency_element.textContent;
    savingData(agency_name);

}

const savingData = (agency_name) => {
    // let agency_name= agency_element.textContent;
    document.cookie = `agencyName=${agency_name};max-age=60`;
    // document.cookie = `agencyName=+${encodeURIComponent(agency_name)};max-age=60`;
    let data = document.cookie.split(';');
    data.forEach(function (value) {
        let content = value.split('=');
        console.log(content[1]);
    })

}
