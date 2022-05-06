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
const changingColor = (newColor) => {
    const specifiedChangingColor = (new_color,i) => {
        let new_color_id = document.getElementById(new_color);
        if(new_color_id.className=='star'+[i]+''){
            new_color_id.classList.add('changing_color');
            Cookies.set('id'+[i]+'',''+[idArray[i]]+'',{expires:1});       
        }else{
            new_color_id.classList.remove('changing_color');
            Cookies.remove('id'+[i]+''); 
        }

    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            specifiedChangingColor(newColor.id,i);
        };

    };

}

const savingData = () => {
    console.log(Cookies.get());
    // console.log(Cookies.get('NAMEを入れて下さい'));
    // 例↓
    console.log(Cookies.get('id0'));
}


window.onload = A();
