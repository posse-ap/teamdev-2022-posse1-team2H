const prefix = "http://localhost/modules/api";

const userPrefix = `${prefix}/user`;
// TOPページのagency呼び出し
const getAgenciesForFirstView = async () => {
  // TODO ローディング表示
  await axios(`${userPrefix}/firstView.php`).then((res) => {
    console.log(res.data);
  });
};

const handleSearch = async () => {
  let industries = [];
  let types = [];
  const industriesTarget = document.getElementsByName("industries");
  const typesTarget = document.getElementsByName("types");
  industriesTarget.forEach((industry) => {
    if (industry.checked === true) industries.push(industry.value);
  });
  typesTarget.forEach((type) => {
    if (type.checked === true) types.push(type.value);
  });
  searchAgencies(types, industries);
};

const searchAgencies = async (types, industries) => {
  types = types.length === 0 ? null : types.join();
  industries = industries.length === 0 ? null : industries.join();
  const params = {
    types: types,
    industries: industries,
  };
  await axios
    .get(`${userPrefix}/searchAgencies.php`, {
      params: params,
    })
    .then((res) => {
      console.log(res.data);
    });
};

window.onload = getAgenciesForFirstView();
