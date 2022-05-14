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
};

const getAgenciesForFirstView = async () => {
  const { data } = await request.get({ url: `${prefix}/firstView.php` });
  console.log(data);
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
