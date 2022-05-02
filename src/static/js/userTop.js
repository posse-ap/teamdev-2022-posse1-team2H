"use strict";

const appearingFunction=(A)=>{
    document.getElementById(A).classList.toggle('appearing');
}

const appearSidebar=()=> {
    appearingFunction("serach_content");
    appearingFunction("search_btn");
};

const appearIndustryTypes=()=> {
    appearingFunction("business_type_items");
};

const appearTypes=()=> {
    appearingFunction("business_features");
};
// 後で見るに追加したモノ一覧を表示するページに遷移します
const transitioning=()=> {
    window.location = "https://posse-ap.com/";
};

const changingColor=(newColor)=> {
    const functionStar=function(){
        
       let new_color=document.getElementById(newColor.id);
        new_color.classList.toggle('chaning_color');
    };
    for(let i=0; i<6;i++){
        if(newColor.id=='star'+[i]+''){
            functionStar();
        }
    };
    
};

const changingColor2=(newColor2)=> {
    const functionStar2=function(){
        
        let new_color2=document.getElementById(newColor2.id);
        new_color2.classList.toggle('chaning_color');
    };
    for(let i=6; i<12;i++){

        if(newColor2.id=='star'+[i]+''){
            functionStar2();
        }
    };
};
