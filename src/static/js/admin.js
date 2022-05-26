"use strict";

const prefix = "http://localhost/modules/api/admin";

const request = {
  get: async (option) => {
    const { url, params } = option;
    try {
      const res = await axios.get(url, {
        params,
        url,
      });
      return {
        data: res.data,
        status: res.status,
      };
    } catch (e) {
      throw handleError(e);
    }
  },

  delete: async (option) => {
    const { url, params } = option;
    try {
      const res = await axios.get(url, {
        params,
        url,
      });
      return {
        data: res.data,
        status: res.status,
      };
    } catch (error) {
      throw handleError(error);
    }
  },
};

const drawHTMLs = {
  contracts: (data) => {
    let text = ``;
    data.forEach((d) => {
      const {
        contract_id,
        agency_name,
        claim,
        contract_year_month,
        amounts,
        user_count,
      } = d;
      console.log(contract_year_month);
      const year = contract_year_month.substr(0, 4);
      const month = contract_year_month.substr(4);
      text += `
      <ol>
        <a href="./contract.php?id=${contract_id}&year=${year}&month=${month}">${agency_name}</a>
        <div>学生獲得数  ${user_count}件</div>
        <div>期限: ${claim}</div>
        <div>金額: ${amounts}円</div>
        </ol>
      `;
    });
    let target = document.getElementById("contracts_target");
    target.innerHTML = text;
  },
  contract: (data) => {
    const {
      agency_id,
      agency_name,
      agency_email,
      contract_id,
      contract_year_month,
      amounts,
      users,
    } = data;
    let usersText = ``;
    users.forEach((d) => {
      const { created_at, name, gender, age, id } = d;
      const genderText = gender == 1 ? "男性" : "女性";
      usersText += `
        <ol>
            <div>情報登録日時: ${created_at}</div>
            <a href="./userDetail.php">${name}</a>
            <div>${genderText}</div>
            <div>${age}歳</div>
            <input id="checkbox${id}" class="checkbox" type="hidden" name="user_id" value="${id}"></input><label id="label${id}" for="checkbox${id}"></label>
        </ol>
      `;
    });
    let text = `<div class="the_agency_info">
    <a href="./agencyDetail.php?agency_id=${agency_id}">${agency_name}</a>
    <div>情報獲得数: ${users.length}件</div>
    <div>期限: ${contract_year_month}</div>
    <div>金額: ${amounts}</div>
</div>
<ul class="agency_list_inner" id="users_target">
${usersText}
</ul>`;

    let target = document.getElementById("contract_target");
    target.innerHTML = text;
  },
};

const enableSelect = () => {
  for (let i = 1; i < 6; i++) {
    let checkbox = document.getElementById(`checkbox${i}`);
    if (checkbox.type !== "checkbox") {
      checkbox.type = "checkbox";
    } else {
      checkbox.type = "hidden";
    }
  }
};

let today = [];
const time = () => {
  let getTime = new Date();
  let year = getTime.getFullYear();
  let month = getTime.getMonth() + 1;
  today.push(year);
  if (month < 10) {
    let num = month;
    let newMonth = ("00" + num).slice(-2);
    today.push(newMonth);
  } else {
    today.push(month);
  }
  let dateToday = today.join(",").replaceAll(",", "-");
  //   console.log(dateToday);
  document.getElementById("date_today").value = dateToday;
};

const getContractId = () => {
  const contractId = document.getElementsByName("contract_id")[0];
  return contractId.value;
};

const getContractYear = () => {
  const year = document.getElementsByName("year")[0];
  return year.value;
};

const getContractMonth = () => {
  const month = document.getElementsByName("month")[0];
  return month.value;
};

const getAgenciesForFirstView = async () => {
  const { data } = await request.get({ url: `${prefix}/contracts.php` });
  drawHTMLs.contracts(data);
};

const handleSearch = async () => {
  let value = document.getElementsByName("yearmonth")[0]; // value = 2022-02
  const yearMonth = value.value.split("-", 2);
  const year = yearMonth[0];
  const month = yearMonth[1];
  const params = {
    year: year,
    month: month,
  };
  const { data } = await searchContracts(params);
  drawHTMLs.contracts(data);
};

const searchContracts = async (params) => {
  const res = await request.get({
    url: `${prefix}/contracts.php`,
    params: params,
  });
  return {
    data: res.data,
    status: res.status,
  };
};

const usersFromContractDetail = async () => {
  const id = getContractId();
  const year = getContractYear();
  const month = getContractMonth();
  const params = {
    contract_id: id,
    year: year,
    month: month,
  };
  const { data } = await request.get({
    url: `${prefix}/usersFromContract.php`,
    params: params,
  });
  drawHTMLs.contract(data);
};

const getUsersFromContract = async (contractId) => {
  const params = {
    contract_id: contractId,
  };
  const res = await request.get({
    url: `${prefix}/usersFromContract.php`,
    params: params,
  });
  return res.data;
};

const getAgencyContractsDetail = async () => {
  const contractId = getContractId();
  const year = getContractYear();
  const month = getContractMonth();

  const params = {
    id: contractId,
    year: year,
    month: month,
  };
  const { data } = await request.get({
    url: `${prefix}/agencyContractDetail.php`,
    params: params,
  });
  drawHTMLs.contract(data);
};

const confirmUsersDelete = async () => {
  if (confirm("本当に削除しますか？")) {
    await handleUsersDelete();
  }
};

const handleUsersDelete = async () => {
  const contractId = document.getElementsByName("contract_id")[0];
  let userIds = [];
  const userTargets = document.getElementsByName("user_id");
  userTargets.forEach((user) => {
    if (user.checked === true) userIds.push(user.value);
  });
  userIds = userIds.join(",");
  const { data } = await deleteUsers(userIds, contractId);
  console.log(data);
  drawHTMLs.contract(data);
};

const deleteUsers = async (userIds, contractId) => {
  const year = getContractYear();
  const month = getContractMonth();
  const params = {
    user_ids: userIds,
    contract_id: contractId,
    year: year,
    month: month,
  };
  const res = await request.delete({
    url: `${prefix}/deleteUser.php`,
    params: params,
  });
  return res;
};

// const getAgencyContractDetail = async (
//   id,
//   year = String(new Date().getFullYear()),
//   month = String(new Date().getMonth - 1)
// ) => {
//   const params = {
//     id: id,
//     year: year,
//     year: month,
//   };
//   const { data } = await request.get({
//     url: `${prefix}/agencyContractDetail.php`,
//     params: params,
//   });
//   console.log(data);
// };

window.onload = () => {
  let indexPage = document.getElementById("top_page");
  if (indexPage) {
    getAgenciesForFirstView();
    time();
  }

  let contractPage = document.getElementById("contract");
  if (contractPage) getAgencyContractsDetail();
};
