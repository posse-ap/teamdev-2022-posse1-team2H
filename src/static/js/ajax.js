const prefix = "http://localhost/modules/ajax"

const getAgencies = async () => {
  // ローディング表示
  await axios(`${prefix}/user/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

window.onload = getAgencies();
