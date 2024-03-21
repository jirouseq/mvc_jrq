/**
 * URL
 */

const url_origin = location.origin;
const url_directory = ""; //"/test/mymvc/"
const URL = url_origin + url_directory;

/**
 *
 * @param {*} method POST || GET
 * @param {*} url url controller and method
 * @param {*} data {key:data}
 * @returns
 */
const send = async (method, url, data) => {
  try {
    const response = await fetch(URL + url, {
      method: method,
      headers: {
        credentials: "same-origin",
        "X-Requested-With": "XMLHttpRequest",
      },
      body: data,
    });

    const responseData = await response.json();

    if (!response.ok) {
      console.log("response failed");
    }

    if (responseData.location) {
      let location = responseData.location;
      delete responseData.location;
      window.location.href = location;
    }

    if (responseData.alerts) {
      localStorage.setItem("alerts", responseData.alerts);
      document.body.insertAdjacentHTML("afterbegin", responseData.alerts);
      delete responseData.alerts;
    }
    return responseData;
  } catch (error) {
    console.error("Error: ", error);
    throw error;
  }
};

/**
 * select picker init
 */
const initPicker = () => {
  $(".selectpicker").selectpicker({
    showIcon: true,
  });
};

/**
 * tooltips
 */
const toolTips = () => {
  let tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
};

/**
 * show alerts after reload
 */
if (localStorage.getItem("alerts") !== null) {
  document.body.insertAdjacentHTML("afterbegin", localStorage.alerts);
  setTimeout(function () {
    const alertBlock = document.querySelector(".alert-block");
    if (alertBlock) {
      alertBlock.remove();
    }
  }, 3500);
  localStorage.removeItem("alerts");
}

/**
 * close alert
 */

const closeAlert = (e) => {
  e.target.closest("div").remove();
};

/**
 * initial tinymce
 */

const initTinymce = (selector) => {
  let lang = document.documentElement.lang;
  if (lang !== "cs") {
    lang = "en_GB";
  }
  tinymce.init({
    selector: selector,
    language: lang,

    relative_urls: false,
    remove_script_host: false,
    document_base_url: `${URL}`,

    content_css:
      "https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css",

    theme: "modern",
    skin: "lightgray",

    width: "100%",
    height: 300,

    plugins: [
      "advlist autolink link image lists charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
      "save table contextmenu directionality emoticons template paste textcolor",
    ],

    toolbar:
      "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons",

    setup: function (editor) {
      send("get", "admin/pages/links/").then((result) => {
        const links = result.map((link) => ({
          title: link.title,
          value: link.value,
        }));
        editor.settings.link_list = links;
        tinymce.init(editor.settings);
      });
    },

    style_formats: [
      {
        title: "Headers",
        items: [
          { title: "Header 1", format: "h1" },
          { title: "Header 2", format: "h2" },
          { title: "Header 3", format: "h3" },
          { title: "Header 4", format: "h4" },
          { title: "Header 5", format: "h5" },
          { title: "Header 6", format: "h6" },
        ],
      },
      {
        title: "Inline",
        items: [
          { title: "Bold", icon: "bold", format: "bold" },
          { title: "Italic", icon: "italic", format: "italic" },
          { title: "Underline", icon: "underline", format: "underline" },
          {
            title: "Strikethrough",
            icon: "strikethrough",
            format: "strikethrough",
          },
          { title: "Superscript", icon: "superscript", format: "superscript" },
          { title: "Subscript", icon: "subscript", format: "subscript" },
          { title: "Code", icon: "code", format: "code" },
        ],
      },
      {
        title: "Blocks",
        items: [
          { title: "Paragraph", format: "p" },
          { title: "Blockquote", format: "blockquote" },
          { title: "Div", format: "div" },
          { title: "Pre", format: "pre" },
        ],
      },
      {
        title: "Alignment",
        items: [
          { title: "Left", icon: "alignleft", format: "alignleft" },
          { title: "Center", icon: "aligncenter", format: "aligncenter" },
          { title: "Right", icon: "alignright", format: "alignright" },
          { title: "Justify", icon: "alignjustify", format: "alignjustify" },
        ],
      },
    ],
    file_browser_callback: function (field, url, type, win) {
      tinyMCE.activeEditor.windowManager.open(
        {
          file:
            `${URL}vendor/kcfinder/browse.php?opener=tinymce4&field=` +
            field +
            "&type=" +
            type,
          title: "KCFinder",
          width: 700,
          height: 500,
          inline: true,
          close_previous: false,
        },
        {
          window: win,
          input: field,
        }
      );
      return false;
    },
  });
};

/**
 * email validation
 */

const isValidEmail = (email) => {
  var re =
    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
};

/**
 * control login user
 */

let inactivityTime = 0;
const inactivityThreshold = 10 * 60 * 1000;

const checkInactivity = () => {
  inactivityTime += 1000;

  if (inactivityTime >= inactivityThreshold) {
    send("get", "logout/logoutResponse/");
  }
};

const resetTimer = () => {
  inactivityTime = 0;
};

document.addEventListener("mousemove", resetTimer);
document.addEventListener("keydown", resetTimer);
setInterval(checkInactivity, 1000);
