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
  const { data } = await searchAgencies(types, industries);
  console.log(data);
};

const searchAgencies = async (types, industries) => {
  types = types.length === 0 ? null : types.join();
  industries = industries.length === 0 ? null : industries.join();
  const params = {
    types: types,
    industries: industries,
  };
  const res = await axios.get(`${userPrefix}/searchAgencies.php`, {
    params: params,
  });

  return {
    data: res.data,
    stauts: res.status,
  };
};

window.onload = () => {
  let userTop = document.getElementById("user_top");
  if (userTop) userTop.onload = getAgenciesForFirstView();
};
