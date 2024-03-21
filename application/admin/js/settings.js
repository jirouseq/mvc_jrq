(() => {
  /* variables */

  const contentDiv = document.getElementById("pageContent");

  /* menu */
  const sortMenu = () => {
    const sortableMenu = document.getElementById("sortableMenu");
    if (sortableMenu) {
      new Sortable(sortableMenu, {
        animation: 150,
        onEnd: function (evt) {
          let order = Array.from(evt.target.children)
            .map((item) => item.dataset.id)
            .join(",");
          send(
            "post",
            "admin/menu/updateSort/",
            JSON.stringify({ sort: order })
          );
        },
      });
    }
  };

  /* setTypeSetting */

  const setTypeSetting = (controller) => {
    send("get", `admin/${controller}/`).then((response) => {
      if (response.template) {
        contentDiv.innerHTML = response.template;
      }
      if (controller === "menu") {
        sortMenu();
      }
    });
  };

  // DOMContentLoaded

  addEventListener("DOMContentLoaded", () => {
    setTypeSetting("menu");
  });

  // click

  document.addEventListener("click", (e) => {});
})();
