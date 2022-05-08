const prefix = "http://localhost/modules/api";

const userPrefix = `${prefix}/admin`;
// TOPページのagency呼び出し
const getAgenciesForFirstView = async () => {
  // TODO ローディング表示
  await axios(`${userPrefix}/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

window.onload= getAgenciesForFirstView();