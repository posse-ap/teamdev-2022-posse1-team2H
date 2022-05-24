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
      const { contract_id, agency_name, claim, amounts, user_count } = d;
      text += `
      <ol>
        <a href="./contract.php?id=${contract_id}">${agency_name}</a>
        <div>学生獲得数  ${user_count}件</div>
        <div>期限: ${claim}</div>
        <div>金額: ${amounts}円</div>
        </ol>
      `;
    });
    let target = document.getElementById("contracts_target")
    target.innerHTML = text
  },
};

const select = () => {
  for (let i = 1; i < 6; i++) {
    let checkbox = document.getElementById(`checkbox${i}`);
    checkbox.type = "checkbox";
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
  console.log(dateToday);
  document.getElementById("date_today").value = dateToday;
};

const getContractId = () => {
  const contractId = document.getElementsByName("contract_id")[0];
  return contractId;
};

const getAgenciesForFirstView = async () => {
  const { data } = await request.get({ url: `${prefix}/firstView.php` });
  drawHTMLs.contracts(data)
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

const handleUsersDelete = async () => {
  const contractId = document.getElementsByName("contract_id")[0];
  let userIds = [];
  const userTargets = document.getElementsByName("user_id");
  userTargets.forEach((user) => {
    if (user.checked === true) userIds.push(user.value);
  });
  await deleteUsers(userIds, contractId).then(() => {
    const users = getUsersFromContract();
    console.log(users);
  });
};

const deleteUsers = async (userIds, contractId) => {
  const params = {
    user_ids: userIds,
    contract_id: contractId,
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
  if (indexPage) getAgenciesForFirstView();
  time();
};
