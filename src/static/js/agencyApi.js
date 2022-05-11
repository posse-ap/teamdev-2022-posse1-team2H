const prefix = "http://localhost/modules/api";

const agencyPrefix = `${prefix}/agency`;

const getUsersForFirstView = async () => {
  await axios(`${agencyPrefix}/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

const sortUsers = async () => {
  const sortMode = document.getElementById("sort").value;
  const params = {
    sortMode: sortMode,
  };
  const res = await axios.get(`${agencyPrefix}/sort.php`, {
    params: params,
  });
  return {
    data: res.data,
    status: res.status,
  };
};

const getManagers = async () => {
  let main = document.getElementById("managers");
  let container = main.getElementById("container");
  container.removeChild();
  const res = await axios.get(`${agencyPrefix}/managers.php`);
  const { data } = res.data;
  let html = ``;
  data.forEach(elem => {
    html += ``;
  });
};

window.onload = () => {
  let agencyTop = document.getElementById("agency_top");
  if (agencyTop) agencyTop.onload = getUsersForFirstView();
  let managersPage = document.getElementById("managers");
  if (managersPage) managersPage.onload = getManagers();
};

const deleteManager = async (id) => {
  const request = async (option) => {
    const { url, params } = option;
    try {
      const res = await axios.delete(url, {
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
  };
  const params = {
    id: id,
  };
  const res = await request({
    url: `${agencyPrefix}/deleteManager.php`,
    params: params,
  });
  return res;
};

// window.onload = getUsersForFirstView();
