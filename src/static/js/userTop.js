"use strict";

let appearing_format=function(A){
    document.getElementById(A).classList.toggle('appearing');
}

function appearSidebar() {
    appearing_format("serach_content");
};

function appearIndustryTypes() {
    appearing_format("business_type_items");
};

function appearTypes() {
    appearing_format("business_features");
};

function transitioning() {
    window.location = "https://posse-ap.com/";
};

function changingColor(newColor) {
    let functionStar=function(){
        
        document.getElementById(newColor.id).classList.toggle('chaning_color');
    };
    for(let i=0; i<6;i++){

        switch (newColor.id) {
            case 'star'+[i]+'':
                functionStar();
                break;
        };
    };
    
};

function changingColor2(newColor2) {
    let functionStar2=function(){
        
        document.getElementById(newColor2.id).classList.toggle('chaning_color');
    };
    for(let i=6; i<12;i++){

        switch (newColor2.id) {
            case 'star'+[i]+'':
                functionStar2();
                break;
        };
    };
};
