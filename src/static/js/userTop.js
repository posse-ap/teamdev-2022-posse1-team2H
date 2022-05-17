"use strict";

const appearing = (appearing) => {
  document.getElementById(appearing).classList.toggle("appearing");
};

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
  await axios("http://localhost/modules/api/user/firstView.php").then((res) => {
    res.data.forEach((elem) => {
      let eachId = elem["id"];
      // console.log(elem['id']);
      idArray.push(eachId);
    });
    // console.log(idArray);
  });
};

const handleClickStar = (agencyId) => {
    toggleColor(agencyId)

}

const toggleColor = (agencyId) => {
  let target = document.getElementById(`star_${agencyId}`);
    target.classList.toggle("toggle_star");
};

const saveFav = (agencyId) => {
  const agencyIds = readFav()
  if (!agencyIds.includes(agencyId)) {
      // add
      agencyIds.push(agencyId)
  } else {
      agencyIds.splice(agencyIds.indexOf(agencyId), 1)
  }
};

const readFav = () => {
    let agencyIds = sessionStorage.getItem('ids')
    agencyIds = agencyIds.split(',')
    agencyIds = agencyIds.map(x => Number(x))
    return agencyIds
}
