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
let newIdArray=[];
const changingColor = (newColor) => {
    const specifiedChangingColor = (new_color, i) => {
        let new_color_id = document.getElementById(new_color);
        if (new_color_id.className == 'star' + [i] + '') {
            new_color_id.classList.add('changing_color');
            newIdArray.push(idArray[i]);
            console.log(newIdArray);
            Cookies.set('ids', newIdArray, { expires: 1 });
            // Cookies.set('ids', [1,2,4], { expires: 1 });
        } else {
            new_color_id.classList.remove('changing_color');
            Cookies.remove('id' + [i] + '');
        }

    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            specifiedChangingColor(newColor.id, i);
        };

    };
}

let displayedData=[];
const savingData = () => {
    console.log(Cookies.get());
    console.log(Cookies.get('ids'));
    let X = Cookies.get();
    console.log(X);
    // console.log(isNaN(Cookies.get('')));
    // displayedData.push(Cookies.get('ids'));
    // console.log(displayedData);
    // let kamo = displayedData.join(',');
    // console.log(kamo);
    // // 二つ以上データを入れると文字列になる。
    // console.log(isNaN(kamo));

    for (let i = 0; i < 12; i++) {
        Cookies.remove('ids');
    }
}


window.onload = displayingData();

Cookies.set('hoge',[1,2,3]);
console.log(Cookies.get());
console.log(Cookies.get('hoge'));