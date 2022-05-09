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

const handleManagerData = async () => {
  let params = new FormData();
  const name = document.forms["manager_add"].elements["name"].value;
  const email = document.forms["manager_add"].elements["email"].value;
  const password = document.forms["manager_add"].elements["password"].value;
  const confirmPassword =
    document.forms["manager_add"].elements["confirm_password"].value;
  const representative =
    document.forms["manager_add"].elements["representative"].checked;

  if (password === confirmPassword && name && email && password) {
    params.append("name", name);
    params.append("email", email);
    params.append("password", password);
    params.append("confirm_password", confirmPassword);
    params.append("representative", representative);

    const {data} = await postData(params)
    console.log(data)

  }
};

const postData = async (data) => {
  const res = await axios.post(`${agencyPrefix}/managerAdd.php`, data);
  return {
    data: res.data,
    status: res.status
  }
}

window.onload = () => {
  let agencyTop = document.getElementById("agency_top");
  if (agencyTop) agencyTop.onload = getUsersForFirstView();
};
