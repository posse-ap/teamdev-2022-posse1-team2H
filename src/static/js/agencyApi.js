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

const getManagers = async () => {
  let main = document.getElementById("managers");
  let container = main.getElementsByClassName("container")[0];
  container.innerHTML = "";
  await axios.get(`${agencyPrefix}/managers.php`).then((res) => {
    const data = res.data
    console.log(res)
    let html = ``;
    if (data !== undefined) {
      for (let i = 0; i < data.length; i++) {
        const elem = data[i];
        html += `<div class="manager">${elem.name} ${elem.email}<button class="delete" onclick="confirmDelete(${elem.id})"></button></div>`;
      }
    } else {
      html = "データがありません";
    }
    container.insertAdjacentHTML("beforeend", html);
  });
};

window.onload = () => {
  let agencyTop = document.getElementById("agency_top");
  if (agencyTop) agencyTop.onload = getUsersForFirstView();
  let managersPage = document.getElementById("managers");
  if (managersPage) managersPage.onload = getManagers();
};

const confirmDelete = async (id) => {
  if (confirm("本当に削除しますか？")) {
    await handleDelete(id);
  }
};

const handleDelete = async (id) => {
  await deleteManager(id)
    .then(() => {
      getManagers();
    })
    .catch((e) => {
      throw e;
    });
};

const deleteManager = async (id) => {
  const request = async (option) => {
    const { url, params } = option;
    try {
      const res = await axios.get(url, {
        params,
        url,
      });
      return {
        data: res.data,
        status: res.status,
      };
    } catch (error) {
      throw handleError(error);
    }
  };

  const params = {
    id: id,
  };
  const res = await request({
    url: `${agencyPrefix}/deleteManager.php`,
    params: params,
  });
  return res;
};

//削除ボタン
function clickEvent() {
  alert('削除します。本当によろしいですか？');
};

// モーダル
;(function(__w,__d){
  var $$event = function(e, m, f){
    if (typeof e.addEventListener !== "undefined"){
      e.addEventListener(m, f, false);
    }
    else if(typeof e.attachEvent !== "undefined"){
      e.attachEvent('on' + m, function(){f.call(e , __w.event)});
    }
  };
  var $$error = function(m){
    console.log("[Modal] Error : "+m);
  };

  var $$ = function(){
    // start
    if(__d.readyState === "complete"){
      this.start();
    }
    else if(__d.readyState === "interactive"){
      $$event(window , "DOMContentLoaded" , (function(e){this.start(e)}).bind(this));
    }
    else{
      $$event(window , "load" , (function(e){this.start(e)}).bind(this));
    }
  };

  $$.prototype.start = function(){
    var switches = __d.querySelectorAll(".modal-switch");
    for(var i=0; i<switches.length; i++){
      $$event(switches[i] , "click" , (function(e){this.click_modalSwitch(e)}).bind(this));
    }
  };

  $$.prototype.click_modalSwitch = function(e){
    if(!e || !e.currentTarget){
      $$error("Not event");
      return;
    }
    var selector = e.currentTarget.getAttribute("data-target-selector");
    if(!selector){
      $$error("Not selector");
      return;
    }
    var target = __d.querySelector(selector);
    if(!target){
      $$error("Not target");
      return;
    }
    this.toggle_modalSwitch(target);

    return false;
  };

  $$.prototype.toggle_modalSwitch = function(element){
    if(!element){
      $$error("Not switch-element");
      return;
    }
    var currentValue = element.getAttribute("data-view");
    if(!currentValue){
      $$event(element , "click" , (function(e){this.toggle_modalSwitch(e.currentTarget)}).bind(this));
    }
    if(currentValue === "1"){
      element.setAttribute("data-view","0");
    }
    else{
      element.setAttribute("data-view","1");
    }
  };

  new $$;
})(window,document);
