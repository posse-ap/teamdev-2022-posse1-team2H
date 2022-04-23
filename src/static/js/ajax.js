const prefix = "http://localhost/modules/api";

// TOPページのagency呼び出し
const getAgencies = async () => {
  // TODO ローディング表示
  await axios(`${prefix}/user/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

window.onload = getAgencies();
