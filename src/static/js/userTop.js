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
    let idArray = [];
    await axios('http://localhost/modules/api/user/firstView.php').then((res) => {

        res.data.forEach(elem => {
            let eachId = elem['id'];
            console.log(elem['id']);
            idArray.push(eachId);

        });
        console.log(idArray);
        for (let i = 0; i < 12; i++) {
            switch (i) {
                case 0:
                    let id_zero = document.getElementById('forSaving' + [i] + '');
                    id_zero.setAttribute("class", `${idArray[i]}`);
                    id_zero.innerHTML = id_zero.className;
                    id_zero.style.display = 'none';
                    break;
                case 1:
                    let id_one = document.getElementById('forSaving' + [i] + '');
                    id_one.setAttribute("class", `${idArray[i]}`);
                    id_one.innerHTML = id_one.className;
                    id_one.style.display = 'none';
                    break;
                case 2:
                    let id_two = document.getElementById('forSaving' + [i] + '');
                    id_two.setAttribute("class", `${idArray[i]}`);
                    break;

            }
        };
    });
};
const changingColor = (newColor) => {
    const specifiedChangingColor = (i) => {
        let new_color = document.getElementById(newColor.id);
        new_color.classList.toggle('changing_color');
        let A = $(new_color).prev().text();
        console.log(Cookies.set(`id${i}`, `${A}`, { expires: 1 / 60 }));
    };
    for (let i = 0; i < 12; i++) {
        if (newColor.id == 'star' + [i] + '') {
            specifiedChangingColor(i);
        };

    };

}

const savingData = () => {
    console.log(Cookies.get());
}


window.onload = A();
