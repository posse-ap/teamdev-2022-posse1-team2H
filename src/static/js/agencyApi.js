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
        sortMode: sortMode
    }
    const res = await axios.get(`${agencyPrefix}/sort.php`, {
        params: params
    })
    return {
        data: res.data,
        status: res.status
    }
}

window.onload = getUsersForFirstView();
