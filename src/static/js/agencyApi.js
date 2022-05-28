const prefix = "http://localhost/modules/api";

const agencyPrefix = `${prefix}/agency`;

const drawHTMLs = {
  users: (data) => {
    text = ``;
    data.forEach(d => {
      const {id, name, email, updated_at, gender, age} = d
      const genderText = gender === 1 ? '男' : '女'
      text += `
      <p class="private_small_box"><a href="detail.php?id=${id}">${updated_at} ${name} ${genderText} ${age}歳 ${email}</a></p>
      `
    })
    let target = document.getElementById('agency_top')
    target.innerHTML = text
  }
}

const getUsersForFirstView = async () => {
  await axios(`${agencyPrefix}/firstView.php`).then((res) => {
    drawHTMLs.users(res.data);
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
const addAgencyManager = () => {
  let overlay = document.getElementById('overlay');
  let modal = document.getElementById('modal');
  let html = document.querySelector('html');
  overlay.style.display = "block";
  modal.style.display = "block";
  html.style.overflow = "hidden";
}

const closingBtn = () => {
  let overlay = document.getElementById('overlay');
  let modal = document.getElementById('modal');
  let html = document.querySelector('html');
  overlay.style.display = "none";
  modal.style.display = "none";
  html.style.overflow = "auto";
}

//お問い合わせ
let radioBoxClick = () => {
  let radioBox1 = document.getElementById("radio1");
  let radioBox2 = document.getElementById("radio2");
  let radioBox3 = document.getElementById("radio3");
  let hidden1 = document.getElementById("hidden1");
  let hidden2 = document.getElementById("hidden2");
  let hidden3 = document.getElementById("hidden3");
  let editChangeTitle = document.getElementById("edit_change_title");
  let editChangeText = document.getElementById("edit_change_text");
  let editChangeIcatch = document.getElementById("edit_change_icatch");
  let studentName = document.getElementById("student_name");
  let studentEmail = document.getElementById("student_email");
  let studentInformationContactReason = document.getElementById("student_information_contact_reason");
  let otherTitle = document.getElementById("other_title");
  let otherContactDetail = document.getElementById("other_contact_detail");

  if (radioBox1.checked) {
    hidden1.style.display = "block";
    editChangeTitle.value = "";
    editChangeText.value = "";
    editChangeIcatch.value = "";
  } else {
    hidden1.style.display = "none";
  }

  if (radioBox2.checked) {
    hidden2.style.display = "block";
    studentName.value = "";
    studentEmail.value = "";
    studentInformationContactReason.value = "";
  } else {
    hidden2.style.display = "none";
  }

  if (radioBox3.checked) {
    hidden3.style.display = "block";
    otherTitle.value = "";
    otherContactDetail.value = "";
  } else {
    hidden3.style.display = "none";
  }
}
