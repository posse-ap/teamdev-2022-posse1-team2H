const prefix = "http://localhost/modules/ajax";

const getAgencies = async () => {
  // TODO ローディング表示
  await axios(`${prefix}/user/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

window.onload = getAgencies();
