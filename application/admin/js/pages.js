(() => {
  /*  data */
  const data = {
    pagination: {
      page: 1,
      perPage: 0,
    },
    search: "",
    order: {
      id: "DESC",
    },
  };

  /* get list */

  const getList = (state = null) => {
    send(
      "post",
      "admin/pages/requestListPages",
      JSON.stringify(state !== null ? state : data)
    ).then((response) => {
      if (document.querySelector("tbody")) {
        table.querySelector("tbody").remove();
        table.querySelector("tfoot").remove();
        table.innerHTML += response.list;
      }
    });
  };

  /* delete page */

  const deletePage = (idGroup) => {
    send("get", "admin/pages/deleteMessageConfirm/").then((response) => {
      let confirmation = confirm(response.confirm);
      if (confirmation) {
        send(
          "post",
          "admin/pages/delete/",
          JSON.stringify({ group_id: idGroup })
        );
      }
    });
  };

  /**
   * sort table
   */
  let table = document.getElementById("tablePages");

  if (table) {
    const selectPerPage = document.getElementById("perPage");
    const search = document.getElementById("searchData");
    const perPageValue = selectPerPage ? selectPerPage.value : 0;
    data.pagination.perPage = perPageValue;

    let href = window.location.href;
    history.pushState(data, "", href);

    /**
     * listener change select option for num per page
     */

    selectPerPage.addEventListener("change", () => {
      data.pagination.perPage = selectPerPage.value;
      getList();
    });

    /**
     * listener for search input
     */

    search.addEventListener("input", () => {
      data.search = search.value.length > 2 ? search.value : "";
      getList();
    });

    /**
     * set switches
     */

    document.addEventListener("change", (e) => {
      if (e.target.matches(".switch")) {
        if (e.target.name === "homepage") {
          let switchesHomepage = document.querySelectorAll("[name='homepage']");
          switchesHomepage.forEach((switchHomepage) => {
            if (switchHomepage !== e.target) {
              switchHomepage.checked = false;
            }
          });
        }
        let idPage = e.target.closest("tr").dataset.groupid;
        let data = {
          data: { [e.target.name]: e.target.checked ? 1 : 0 },
          condition: { group_id: idPage },
        };
        send("post", "admin/pages/save/", JSON.stringify(data));
      }
    });

    /**
     * listener for delete buttons in table
     */

    document.addEventListener("click", (e) => {
      if (e.target.closest(".btn-delete-page")) {
        let groupId = e.target.closest("tr").dataset.groupid;
        deletePage(groupId);
      }
    });
  }

  /**
   * save data
   */

  const saveData = (dataSave) => {
    let form = document.querySelector("form.active");
    let idPage = form.querySelector("#idPage").value;
    let data = { data: dataSave, condition: { id: idPage } };
    send("post", "admin/pages/save/", JSON.stringify(data));
  };

  /**
   * init tinymce
   */

  const initEditor = () => {
    initTinymce(".textEditor");
    let editors = document.querySelectorAll(".textEditor");
    editors.forEach((edit) => {
      let editor = tinymce.get(edit.id);
      editor.on("KeyUp", (e) => {
        saveData({ text: editor.getContent() });
      });
      editor.on("Change", (e) => {
        saveData({ text: editor.getContent() });
      });
    });
  };

  /* change language content */

  const changeLanguageContent = (languageCode) => {
    let versionsContent = document.querySelectorAll("[data-version]");
    versionsContent.forEach((content) => {
      if (content.dataset.version === languageCode) {
        content.classList.remove("d-none");
        content.classList.add("active");
      } else {
        content.classList.add("d-none");
        content.classList.remove("active");
      }
    });
  };

  /**
   * form parent language content
   */

  const changeLanguageLink = (e) => {
    document
      .querySelector(".language-form-link.active")
      .classList.remove("active");
    e.target.classList.add("active");
    changeLanguageContent(e.target.dataset.code);
  };

  /**
   * listener click
   */

  document.addEventListener("click", (e) => {
    if (e.target.matches(".page-link")) {
      e.preventDefault();
      data.pagination.page = e.target.dataset.page;
      getList();
      let href = e.target.getAttribute("href");
      history.pushState(data, "", href);
    } else if (e.target.matches(".icon-sort")) {
      let colName = e.target.closest("th").dataset.colName;
      let typeSort = e.target.dataset.order;
      data.order = { [colName]: typeSort };
      if (document.querySelector(".icon-sort.active")) {
        document.querySelector(".icon-sort.active").classList.remove("active");
      }
      e.target.classList.add("active");
      getList();
    } else if (e.target.matches(".language-form-link")) {
      changeLanguageLink(e);
    } else if (e.target.id === "deletePage") {
      deletePage(document.getElementById("groupId").value);
    }
  });

  /**
   * popstate
   */

  window.addEventListener("popstate", function (event) {
    let state = event.state;
    if (state) {
      getList(state);
    }
  });

  /**
   * DOMContentLoaded
   */

  window.addEventListener("DOMContentLoaded", () => {
    initEditor();
    if (document.getElementById("linkEdit")) {
      history.pushState(null, null, document.getElementById("linkEdit").value);
    }
  });

  /* listener change */

  document.addEventListener("change", (e) => {
    if (e.target.matches(".select-role")) {
      role(e);
    }
  });

  /* listener input */

  document.addEventListener("input", (e) => {
    if (
      e.target.nodeName === "TEXTAREA" ||
      (e.target.nodeName === "INPUT" && e.target.type === "text")
    ) {
      if (e.target.closest("form.active")) {
        let data = { [e.target.name]: e.target.value };
        saveData(data);
      }
    }
  });
})();
