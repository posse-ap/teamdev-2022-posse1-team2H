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

//モーダル
;(function(__w,__d){
  let $$event = (e, m, f) => {
    if (typeof e.addEventListener !== "undefined"){
      e.addEventListener(m, f, false);
    }
    else if(typeof e.attachEvent !== "undefined"){
      e.attachEvent('on' + m, function(){f.call(e , __w.event)});
    }
  };
  let $$error = (m) => {
    console.log("[Modal] Error : "+m);
  };

  let $$ = function(){
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
    let switches = __d.querySelectorAll(".modal_switch");
    for(let i=0; i<switches.length; i++){
      $$event(switches[i] , "click" , (function(e){this.click_modalSwitch(e)}).bind(this));
    }
  };

  $$.prototype.click_modalSwitch = function(e) {
    if(!e || !e.currentTarget){
      $$error("Not event");
      return;
    }
    let selector = e.currentTarget.getAttribute("data-target-selector");
    if(!selector){
      $$error("Not selector");
      return;
    }
    let target = __d.querySelector(selector);
    if(!target){
      $$error("Not target");
      return;
    }
    this.toggle_modalSwitch(target);

    return false;
  };

  $$.prototype.toggle_modalSwitch = (element) => {
    if(!element){
      $$error("Not switch-element");
      return;
    }
    let currentValue = element.getAttribute("data-view");
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

//追加アラート
function clickEvent() {
  alert('この個人情報を追加します。よろしいですか？');
};

//お問い合わせ
function buttonClick() {
  let radioBox1 = document.getElementById("radio1");
  let radioBox2 = document.getElementById("radio2");
  let radioBox3 = document.getElementById("radio3");
  let hidden1 = document.getElementById("hidden1");
  let hidden2 = document.getElementById("hidden2");
  let hidden3 = document.getElementById("hidden3");
  let txt1 = document.getElementById("txt1");
  let txt2 = document.getElementById("txt2");
  let txt3 = document.getElementById("txt3");
  let txt4 = document.getElementById("txt4");
  let txt5 = document.getElementById("txt5");
  let txt6 = document.getElementById("txt6");
  let txt7 = document.getElementById("txt7");
  let txt8 = document.getElementById("txt8");

  if (radioBox1.checked) {
    hidden1.style.display = "block";
    txt1.value = "";
    txt2.value = "";
    txt3.value = "";
  } else {
    hidden1.style.display = "none";
  }

  if (radioBox2.checked) {
    hidden2.style.display = "block";
    txt4.value = "";
    txt5.value = "";
    txt6.value = "";
  } else {
    hidden2.style.display = "none";
  }

  if (radioBox3.checked) {
    hidden3.style.display = "block";
    txt7.value = "";
    txt8.value = "";
  } else {
    hidden3.style.display = "none";
  }
}