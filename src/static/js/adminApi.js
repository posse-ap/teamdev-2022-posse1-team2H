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

const getContractId = () => {
  const contractId = document.getElementsByName("contract_id")[0];
  return contractId;
};

const getAgenciesForFirstView = async () => {
  const { data } = await request.get({ url: `${prefix}/firstView.php` });
  console.log(data);
};

const getUsersFromContract = async (contractId) => {
  const params = {
    contract_id: contractId,
  }
  const res = await request.get({
    url: `${prefix}/usersFromContract.php`,
    params: params
  });
  return res.data
};

const handleUsersDelete = async () => {
  const contractId = document.getElementsByName("contract_id")[0];
  let userIds = [];
  const userTargets = document.getElementsByName("user_id")
  userTargets.forEach(user => {
    if (user.checked === true) userIds.push(user.value)
  })
  await deleteUsers(userIds, contractId).then(() => {
    const users = getUsersFromContract();
    console.log(users)
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

window.onload = getAgenciesForFirstView();
