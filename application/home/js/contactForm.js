(() => {
  /* contact form */

  const form = document.getElementById("formContact");

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

  /* subject validation */

  const subject = document.getElementById("subject");
  subject.addEventListener("input", () => {
    if (subject.value.length > 1) {
      validFeedback(subject);
    } else {
      invalidFeedback(subject);
    }
  });

  /* body validation */

  const body = document.getElementById("body");
  body.addEventListener("input", () => {
    if (body.value.length > 1) {
      validFeedback(body);
    } else {
      invalidFeedback(body);
    }
  });

  /* email validation */

  const email = document.getElementById("email");
  email.addEventListener("input", () => {
    if (isValidEmail(email.value)) {
      validFeedback(email);
    } else {
      invalidFeedback(email);
    }
  });

  /* form validation */

  const validateForm = (formContact, e) => {
    const form = formContact;
    const requiredFields = form.querySelectorAll("[required]");

    let isValid = true;

    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        isValid = false;
        invalidFeedback(field);
      }
    });

    // Validate email field
    if (!isValidEmail(email.value)) {
      isValid = false;
      invalidFeedback(email);
    } else {
      validFeedback(email);
    }

    if (!isValid) {
      e.preventDefault();
      e.stopPropagation();
    }

    return isValid;
  };

  /* event submit */

  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let formData = new FormData(form);
    if (validateForm(form, e)) {
      send("post", "contactForm/sendForm", formData).then((response) => {
        console.log(response);
      });
    }
  });
})();
