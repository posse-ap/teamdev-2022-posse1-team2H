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
  let container = main.getElementsByClassName("container")[0];
  container.innerHTML = "";
  await axios.get(`${agencyPrefix}/managers.php`).then((res) => {
    const data = res.data
    console.log(res)
    let html = ``;
    if (data !== undefined) {
      for (let i = 0; i < data.length; i++) {
        const elem = data[i];
        html += `<div class="manager">${elem.name} ${elem.email}<button class="delete" onclick="confirmDelete(${elem.id})"></button></div>`;
      }
    } else {
      html = "データがありません";
    }
    container.insertAdjacentHTML("beforeend", html);
  });
};

window.onload = () => {
  let agencyTop = document.getElementById("agency_top");
  if (agencyTop) agencyTop.onload = getUsersForFirstView();
  let managersPage = document.getElementById("managers");
  if (managersPage) managersPage.onload = getManagers();
};

const confirmDelete = async (id) => {
  if (confirm("本当に削除しますか？")) {
    await handleDelete(id);
  }
};

const handleDelete = async (id) => {
  await deleteManager(id)
    .then(() => {
      getManagers();
    })
    .catch((e) => {
      throw e;
    });
};

const deleteManager = async (id) => {
  const request = async (option) => {
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
