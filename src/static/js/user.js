const prefix = "http://localhost/modules/api";

const userPrefix = `${prefix}/user`;

const drawHTMLs = {
  agencies: (data) => {
    let text = ``;
    data.forEach((d) => {
      const { id, name, title, eyecatch_url, industries, types } = d;
      let tags = ``;
      for (let i = 0; i < types.length; i++) {
        tags += `<a href=""><span class="filling"></span>#${types[i].agency_type}</a>`;
      }
      text += `
    <article class="new_agency_card">
        <div class="agency_img">
            <a href="detail.php?id=${id}">
                <img src="${eyecatch_url}" alt="${name}">
            </a>
        </div>
        <div class="agency_card_content">
            <div class="agency_infromation">
                <div class="name_and_favorite">
                    <div class="agency_name_wrapper"><span id="agency_name${id}" class="agency_name">${name}</span></div>
                    <div id="star_${id}" class="star" onclick="handleClickStar(${id})"><i class="fa-solid fa-star"></i></div>
                </div>
                <div class="agency_slogan_wrapper"><span class="slogan">${title}</span></div>
            </div>
            <div class="agency_tags_wrapper">
                <i class="fa-solid fa-tags" style="color: #9E9E9E"></i>
                ${tags}
            </div>
        </div>
    </article>
    `;
    });
    let agencyTarget = document.getElementById("new_agencies_target");
    agencyTarget.innerHTML = text;
  },
  favs: (data) => {
    let text = ``;
    if (data.length === 0) {
      text = "後で見るには何もありません";
    } else {
      for (let i = 0; i < data.length; i++) {
        const { id, name, title, industries, types, eyecatch } = data[i];
        let industriesText = ``;
        let typesText = ``;

        industries.forEach((industry) => {
          industriesText += `<a href="">#${industry.industry}</a>`;
        });
        types.forEach((type) => {
          typesText += `<a href="">#${type.agency_type}</a>`;
        });

        text += `
        <div class="user_likelist_inner1box">
            <div class="user_likelist_inner1">
              <div class="user_likelist_inner1_header">
                <h2 class="user_likelist_inner1_header_title">${name}</h2>
                <div class="user_likelist_inner1_trash">
                  <h3 class="user_likelist_inner1_trash_text" onclick="handleRemoveFromFav(${id})">削除する</h3>
                </div>
              </div>
              <div class="user_likelist_inner1_body">

                <img src="${eyecatch}" alt="${name}" class="user_likelist_inner1_body_img">

               <div class="user_likelist_inner1_body_right">
                  <div class="user_likelist_inner1_body_text">
                    <p class="user_likelist_inner1_body_text_catchcopy">${title}</p>
                    <div class="user_likelist_inner1_body_text_connection">
                      ${industriesText}
                      ${typesText}
                    </div>
                    <div class="user_likelist_inner1_body_under_responsive">
                      <a href="./contact.php?ids=${id}" class="user_likelist_inner1_body_under_contactr_responsive"><div>問い合わせる</div></a>
                      <a href="./detail.php?id=${id}" class="user_likelist_inner1_body_under_detailr_responsive"><div>詳細ページ</div></a>
                    </div>
                  </div> 
                </div>
             </div>
              <div class="user_likelist_inner1_body_under">
                <a href="./contact.php?ids=${id}" class="user_likelist_inner1_body_under_contact"><div>問い合わせる</div></a>
                <a href="./detail.php?id=${id}" class="user_likelist_inner1_body_under_detail"><div>詳細ページ</div></a>
              </div>

            </div>

          </div>`;
      }
    }
    let favTarget = document.getElementById("fav_target");
    favTarget.innerHTML = text;
  },
};

const getAgenciesForFirstView = async () => {
  // TODO ローディング表示
  const res = await axios(`${userPrefix}/firstView.php`);
  const { data } = res;
  drawHTMLs.agencies(data);
};

const handleSearch = async () => {
  let industries = [];
  let types = [];
  const industriesTarget = document.getElementsByName("industries");
  const typesTarget = document.getElementsByName("types");
  industriesTarget.forEach((industry) => {
    if (industry.checked === true) industries.push(industry.value);
  });
  typesTarget.forEach((type) => {
    if (type.checked === true) types.push(type.value);
  });
  const { data } = await searchAgencies(types, industries);
  drawHTMLs.agencies(data);
};

const searchAgencies = async (types, industries) => {
  types = types.length === 0 ? null : types.join();
  industries = industries.length === 0 ? null : industries.join();
  const params = {
    types: types,
    industries: industries,
  };
  const res = await axios.get(`${userPrefix}/searchAgencies.php`, {
    params: params,
  });

  return {
    data: res.data,
    stauts: res.status,
  };
};

const getFavs = async () => {
  const agencyIds = sessionStorage.getItem("ids");
  const params = {
    agency_ids: agencyIds,
  };
  await axios
    .get(`${userPrefix}/fav.php`, {
      params: params,
    })
    .then((res) => {
      drawHTMLs.favs(res.data);
    });
};

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

const handleSaveFav = (agencyId) => {
  const favs = readFav();
  if (!favs.includes(agencyId)) {
    saveFav(agencyId);
    alert("「後で見る」に保存しました");
  } else {
    alert("すでに「後で見る」に存在しています");
  }
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

const handleRemoveFromFav = async (agencyId) => {
  removeFromFav(agencyId);
  await getFavs();
  countFavs();
  contactAll();
};

const removeFromFav = (agencyId) => {
  let favs = readFav();
  if (!favs.includes(agencyId)) return;
  favs.splice(favs.indexOf(agencyId), 1);
  sessionStorage.setItem("ids", favs);
};

const countFavs = () => {
  const favs = readFav();
  let target = document.getElementById("fav_count");
  target.innerText = favs.length;
};

const readFav = () => {
  let agencyIds = sessionStorage.getItem("ids");
  if (agencyIds) {
    agencyIds = agencyIds.split(",");
    agencyIds = agencyIds.map((x) => Number(x));
    return agencyIds;
  }
  return [];
};

const deleteFav = () => {
  sessionStorage.removeItem("ids");
};

const changeStarsColor = () => {
  const ids = readFav();
  for (let i = 0; i < ids.length; i++) {
    toggleColor(ids[i]);
  }
};

const diplayingCompanyInfo = () => {
  let contentDetail = document.getElementById(
    "content_detail_subcontent_right_serch_information_details"
  );
  contentDetail.classList.toggle("add");
};

const allowTransition = () => {
  let checkedCheckbox = document.getElementById('user_inquary_content_inner_confirmation_inner_checkbox');
  let link = document.getElementById('user_inquary_content_inner_submit_button');
  if (checkedCheckbox.checked) {
    link.style.pointerEvents = 'auto';
  } else {
    link.style.pointerEvents = 'none';
  }
}

const dispalyingSerachArea = () => {
  let overlay = document.getElementById('overlay');
  let modal = document.getElementById('modal');
  let html = document.querySelector('html');
  overlay.style.display = "block";
  modal.style.display = "block";
  html.style.overflow = "hidden";
}

const closingBtn = () => {
  let overlay = document.getElementById('overlay');
  let modal = document.getElementById('modal');
  let html = document.querySelector('html');
  overlay.style.display = "none";
  modal.style.display = "none";
  html.style.overflow = "auto";
}

const contactAll = () => {
  let target = document.getElementById('contact_all')
  const ids = sessionStorage.getItem("ids")
  target.innerHTML = `<a href="./contact.php?ids=${ids}">まとめて問い合わせる</a>`
}

window.onload = async () => {
  const userTop = document.getElementById("user_top");
  if (userTop) {
    await getAgenciesForFirstView();
    changeStarsColor();
  }
  const favPage = document.getElementById("fav_page");
  if (favPage) {
    countFavs();
    contactAll();
    await getFavs();
  }
};
