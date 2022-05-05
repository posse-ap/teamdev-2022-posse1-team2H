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

// const checkingColor = (new_color_class_name) => {
//     // 押した時の色で判別
//     if (new_color_class_name !== 'star chaning_color') {
//         console.log('青');
//     } else {
//         ;
//     }
// }

// const A = () => {
//     console.log(new_color_id);
//     if(new_color_id){
//         for (let i = 0; i < 12; i++) {
//             var agency_element = document.getElementById('agency_name' + [i] + '');
//         }
//         let agency_name = agency_element.textContent;

//     }

// }

// const savingData = (agency_name) => {
//     A();
//     // let agency_name= agency_element.textContent;
//     document.cookie = `agencyName=${agency_name};max-age=60`;
//     // document.cookie = `agencyName=+${encodeURIComponent(agency_name)};max-age=60`;
//     let data = document.cookie.split(';');
//     data.forEach(function (value) {
//         let content = value.split('=');
//         console.log(content[1]);
//     })

// }

// let agency_names = [];
// let agency_name = document.getElementsByClassName('agency_name');
// for (let j = 0; j < agency_name.length; j++) {
//     var R = agency_name.item(j).id;
//     agency_names.push(R);
// }
// console.log(agency_names);
let  array=[
    {id:'star0', class:'agency_name0'},
    {id:'star1', class:'agency_name1'},
    {id:'star2', class:'agency_name2'},
    {id:'star3', class:'agency_name3'},
    {id:'star4', class:'agency_name4'},
    {id:'star5', class:'agency_name5'},
    {id:'star6', class:'agency_name6'},
    {id:'star7', class:'agency_name7'},
    {id:'star8', class:'agency_name8'},
    {id:'star9', class:'agency_name9'},
    {id:'star10', class:'agency_name10'},
    {id:'star11', class:'agency_name11'},
    
]

console.log(array[0].id);


let x = [];
function savingData() {
    // const array={
    //     star0:'agency_name0',
    //     star1:'agency_name1',
    //     star2:'agency_name2',
    //     star3:'agency_name3',
    //     star4:'agency_name4',
    //     star5:'agency_name5',
    //     star6:'agency_name6',
    //     star7:'agency_name7',
    //     star8:'agency_name8',
    //     star9:'agency_name9',
    //     star10:'agency_name10',
    //     star11:'agency_name11',
    // }
   
    // console.log(array);
    let A = document.getElementsByClassName('star changing_color');
    for (var L = 0; L < A.length; L++) {
        // let replacing =x[L].replace('star','')
        // console.log(replacing);
        // console.log(x[L].replace('star',''));
        // console.log(array.map(array=>array[`star${replacing}`]))      
        var B = A.item(L);
        var C = B.id;
        x.push(C);
        console.log(x);
        console.log(x[L]);
        let replaceing = x[L].replace('star','');
        console.log(replaceing);
        if(x[L]==array[replaceing].id){
            let P= array[replaceing].class;
            console.log(P);
            console.log(document.getElementById(P).textContent);

        }
        // if(x[L]==array.map(array=>array[`star${replacing}`])){
        //     var B = array.map(array=>array[`star${replacing}`]);
        //     console.log(array.B.textContent);
        // }
        
    }


}



// for文で連想配列を作成
// if( stari in array)



// savingData(){
    // 青色に光っているかどうか

    // どのカードなのか

    // if文両方の条件を満たしているもの。
//  }