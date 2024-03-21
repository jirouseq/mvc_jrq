(() => {
  /**
   * invalid feedback
   */

  const invalidFeedback = (el) => {
    let feedback = el.closest("div").querySelector(".invalid-feedback");
    el.classList.add("is-invalid");
    el.classList.remove("is-valid");
    feedback.style.display = "block";
  };

  /**
   * valid feedback
   */

  const validFeedback = (el) => {
    let feedback = el.closest("div").querySelector(".invalid-feedback");
    el.classList.add("is-valid");
    el.classList.remove("is-invalid");
    feedback.style.display = "none";
  };

  /**
   * password validation
   */

  const password = document.getElementById("password");
  if (password) {
    password.addEventListener("input", () => {
      if (password.value.length > 7) {
        validFeedback(password);
      } else {
        invalidFeedback(password);
      }
    });
  }

  /**
   * password again validation
   */

  const passwordAgain = document.getElementById("passwordAgain");
  if (passwordAgain) {
    passwordAgain.addEventListener("input", () => {
      if (password.value === passwordAgain.value) {
        validFeedback(passwordAgain);
      } else {
        invalidFeedback(passwordAgain);
      }
    });
  }

  /**
   * form validation
   */

  const validateForm = (e) => {
    const form = e.target;
    const requiredFields = form.querySelectorAll("[required]");

    let isValid = true;

    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        isValid = false;
        invalidFeedback(field);
      }
    });

    if (password.value !== passwordAgain.value) {
      invalidFeedback(passwordAgain);
      isValid = false;
    }

    if (!isValid) {
      e.preventDefault();
      e.stopPropagation();
    }

    return isValid;
  };

  /**
   * registration form
   */

  const form = document.getElementById("formRestorePassword");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      let formData = new FormData(form);
      if (validateForm(e)) {
        send("post", "forgottenPassword/restore/", formData);
      }
    });
  }
})();
