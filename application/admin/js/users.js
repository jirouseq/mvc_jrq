(() => {
  /* variables */

  const table = document.querySelector("table");
  const selectPerPage = document.getElementById("perPage");
  const search = document.getElementById("searchData");

  /* data */

  const data = {
    pagination: {
      page: 1,
      perPage: selectPerPage.value,
    },
    search: "",
    order: {},
  };

  /* get list users */

  const getList = (state = null) => {
    send(
      "post",
      "admin/users/getResponse",
      JSON.stringify(state !== null ? state : data)
    ).then((response) => {
      if (document.querySelector("tbody")) {
        table.querySelector("tbody").remove();
        table.querySelector("tfoot").remove();
      }
      table.innerHTML += response.list;
    });
  };

  /**
   * ban user
   */

  const ban = (e) => {
    let data = {
      id: e.target.closest("tr").id,
      banned: e.target.checked ? 1 : 0,
    };
    send("post", "admin/users/ban", JSON.stringify(data));
  };

  /**
   * change role for user
   */

  const role = (e) => {
    let data = {
      id: e.target.closest("tr").id,
      role: e.target.value,
    };
    send("post", "admin/users/role", JSON.stringify(data));
  };

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
    }
  });

  /**
   * listener change
   */

  document.addEventListener("change", (e) => {
    if (e.target.matches(".select-role")) {
      role(e);
    } else if (e.target.matches(".switch-ban")) {
      ban(e);
    }
  });

  /**
   * popstate
   */

  window.addEventListener("popstate", function (event) {
    var state = event.state;
    if (state) {
      getList(state);
    }
  });

  /**
   * DOMContentLoaded
   */

  window.addEventListener("DOMContentLoaded", () => {
    let href = window.location.href;
    history.pushState(data, "", href);
  });
})();
