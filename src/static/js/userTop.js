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

const handleClickStar = (agencyId) => {
  toggleColor(agencyId);
  saveFav(agencyId);
};

const toggleColor = (agencyId) => {
  let target = document.getElementById(`star_${agencyId}`);
  target.classList.toggle("toggle_star");
};

const saveFav = (agencyId) => {
  let agencyIds = readFav();
  if (agencyIds === undefined) {
    agencyIds = [];
  }
  if (!agencyIds.includes(agencyId)) {
    agencyIds.push(agencyId);
  } else {
    agencyIds.splice(agencyIds.indexOf(agencyId), 1);
  }
  sessionStorage.setItem("ids", agencyIds);
};

const readFav = () => {
  let agencyIds = sessionStorage.getItem("ids");
  if (agencyIds) {
    agencyIds = agencyIds.split(",");
    agencyIds = agencyIds.map((x) => Number(x));
    return agencyIds;
  }
};
