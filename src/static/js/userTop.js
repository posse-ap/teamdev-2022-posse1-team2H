"use strict";

const appearing = (appearingArguments) => {
    document.getElementById(appearingArguments).classList.toggle('appearing');
}

const appearSidebar = () => {
    appearing("serach_content");
    appearing("search_btn");
};

const appearIndustryTypes = () => {
    appearing("business_type_items");
};

const appearTypes = () => {
    appearing("business_features");
};
// 後で見るに追加した企業の一覧を表示するページに遷移します
const transitioning = () => {
    window.location = "https://posse-ap.com/";
};

const changingColor = (newColor) => {
    const specifiedChangingColor = () => {
        let new_color = document.getElementById(newColor.id);
        new_color.classList.toggle('chaning_color');
    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            specifiedChangingColor();
        }
    };

};

