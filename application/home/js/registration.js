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
   * username validation
   */

  const username = document.getElementById("username");
  username.addEventListener("input", () => {
    if (username.value.length > 1) {
      validFeedback(username);
    } else {
      invalidFeedback(username);
    }
  });

  /**
   * email validation
   */

  const email = document.getElementById("userEmail");
  let oldMessage = null;
  email.addEventListener("input", () => {
    if (isValidEmail(email.value)) {
      send(
        "post",
        "registration/controlEmail/",
        JSON.stringify({ email: email.value })
      ).then((response) => {
        if (response.status === false) {
          oldMessage = email.nextElementSibling.innerHTML;
          email.nextElementSibling.innerHTML = response.message;
          invalidFeedback(email);
        }
      });
      validFeedback(email);
    } else {
      if (oldMessage !== null) {
        email.nextElementSibling.innerHTML = oldMessage;
      }
      invalidFeedback(email);
    }
  });

  /**
   * validatePasswordAgain
   */

  const validatePassword = () => {
    if (password.value.length > 7) {
      validFeedback(password);
    } else {
      invalidFeedback(password);
    }
    validatePasswordAgain();
  };

  /**
   * password validation
   */

  const password = document.getElementById("password");
  password.addEventListener("input", () => {
    validatePassword();
  });

  /**
   * validatePasswordAgain
   */

  const validatePasswordAgain = () => {
    if (
      passwordAgain.value.length > 7 &&
      passwordAgain.value === password.value
    ) {
      validFeedback(passwordAgain);
    } else {
      invalidFeedback(passwordAgain);
    }
  };

  /**
   * password again input
   */

  const passwordAgain = document.getElementById("passwordAgain");
  passwordAgain.addEventListener("input", () => {
    validatePasswordAgain();
  });

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

  const form = document.getElementById("formRegistration");
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let formData = new FormData(form);
    if (validateForm(e)) {
      send("post", "registration/add/", formData);
    }
  });
})();
