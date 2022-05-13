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
  console.log(data)
};

window.onload = getAgenciesForFirstView();
