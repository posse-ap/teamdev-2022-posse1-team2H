const prefix = "http://localhost/modules/api";

const agencyPrefix = `${prefix}/agency`;

const getUsersForFirstView = async () => {
  await axios(`${agencyPrefix}/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

window.onload = getUsersForFirstView();
