(() => {
  /* variables */

  const buttonChangePassword = document.getElementById(
    "profileChangePasswordBtn"
  );
  const inputsPassword = document.getElementById("profileChangePassword");
  const form = document.getElementById("formProfile");

  /* hide feedback */

  const hideFeedback = (el) => {
    if (el.classList.contains("is-invalid")) {
      console.log(el);
      el.classList.remove("is-invalid");
      el.closest("div").querySelector(".invalid-feedback").style.display =
        "none";
    }

    if (el.classList.contains("is-valid")) {
      el.classList.remove("is-valid");
    }
  };

  /* invalid feedback */

  const invalidFeedback = (el) => {
    let feedback = el.closest("div").querySelector(".invalid-feedback");
    el.classList.add("is-invalid");
    el.classList.remove("is-valid");
    feedback.style.display = "block";
  };

  /* valid feedback */

  const validFeedback = (el) => {
    let feedback = el.closest("div").querySelector(".invalid-feedback");
    el.classList.add("is-valid");
    el.classList.remove("is-invalid");
    feedback.style.display = "none";
  };

  /* validate username */

  const username = document.getElementById("username");
  username.addEventListener("input", () => {
    if (username.value.length > 1) {
      validFeedback(username);
    } else {
      invalidFeedback(username);
    }
  });

  /* validate email */

  const email = document.getElementById("userEmail");
  email.addEventListener("input", () => {
    if (isValidEmail(email.value)) {
      validFeedback(email);
    } else {
      invalidFeedback(email);
    }
  });

  /* validatePasswordAgain */

  const validatePassword = () => {
    if (password.value.length > 0) {
      if (password.value.length > 7) {
        validFeedback(password);
      } else {
        invalidFeedback(password);
      }
      validatePasswordAgain();
    }
  };

  /**
   * password validation
   */

  const password = document.getElementById("password");
  password.addEventListener("input", () => {
    validatePassword();
  });

  /* validatePasswordAgain */
  const validatePasswordAgain = () => {
    if (passwordAgain.value.length > 0) {
      if (
        passwordAgain.value.length > 7 &&
        passwordAgain.value === password.value
      ) {
        validFeedback(passwordAgain);
      } else {
        invalidFeedback(passwordAgain);
      }
    }
  };

  /* password again input */

  const passwordAgain = document.getElementById("passwordAgain");
  passwordAgain.addEventListener("input", () => {
    validatePasswordAgain();
  });

  /* form validation */

  const validateForm = (e) => {
    const requiredFields = form.querySelectorAll("[required]");
    let isValid = true;

    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        isValid = false;
        invalidFeedback(field);
      }
    });

    // validate email field
    const userEmail = document.getElementById("userEmail");
    if (!isValidEmail(userEmail.value)) {
      isValid = false;
      invalidFeedback(userEmail);
    } else {
      validFeedback(userEmail);
    }

    if (!isValid) {
      e.preventDefault();
      e.stopPropagation();
    }

    return isValid;
  };

  /**
   * events
   */

  // click buttonChangePassword

  buttonChangePassword.addEventListener("click", (e) => {
    e.preventDefault();
    inputsPassword.classList.toggle("d-none");
    if (inputsPassword.classList.contains("d-none")) {
      password.value = "";
      passwordAgain.value = "";
      hideFeedback(password);
      hideFeedback(passwordAgain);
    }
  });

  // submit form

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    if (validateForm(e)) {
      send("post", "profile/changeProfile", formData).then((response) => {
        console.log(response);
      });
    }
  });
})();
