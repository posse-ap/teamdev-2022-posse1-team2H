<<<<<<< HEAD
const prefix = "http://localhost/modules/api";
=======
const prefix = "http://localhost/modules/api"
>>>>>>> 89eb9c0... save code

// TOPページのagency呼び出し
const getAgencies = async () => {
  // TODO ローディング表示
  await axios(`${prefix}/user/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

window.onload = getAgencies();
