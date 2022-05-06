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
    let starChangingClass = document.getElementsByClassName('star changing_color');
    for (let i = 0; i < starChangingClass.length; i++) {
        let starContent = starChangingClass.item(i);
        let starContentId = starContent.id;
        let A = document.getElementById(starContentId);
        let agencyNameId = starContentId.replace('star', 'agency_name')
        document.cookie = `agencyId${i}=${agencyNameId};max-age=60`;
        let data = document.cookie.split(';');
        let changedData = data.pop();
        console.log(A);
        console.log(A.className=starContentId);
        backToColor(A);
        displayingData(changedData);
        // backToColor(starContent);
    }


}

// const backToColor=(starContentId)=>{
    
// }

const displayingData = (changedData) => {
    let data = changedData;
    let arrayData = data.split('=');
    console.log(arrayData);
    let agencyName = arrayData.pop();
    console.log(agencyName);


}




