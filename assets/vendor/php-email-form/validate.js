(function () {
  "use strict";

  let forms = document.querySelectorAll(".php-email-form");

  forms.forEach(function (e) {
    e.addEventListener("submit", function (event) {
      event.preventDefault();

      let thisForm = this;
      let action = thisForm.getAttribute("action");

      if (!action) {
        displayError(thisForm, "The form action property is not set!");
        return;
      }

      thisForm.querySelector(".loading").classList.add("d-block");
      thisForm.querySelector(".error-message").classList.remove("d-block");
      thisForm.querySelector(".sent-message").classList.remove("d-block");

      let formData = new FormData(thisForm);

      fetch(action, {
        method: "POST",
        body: formData,
        headers: { "X-Requested-With": "XMLHttpRequest" },
      })
        .then((response) => {
          if (response.ok) {
            return response.text();
          } else {
            throw new Error(
              `${response.status} ${response.statusText} ${response.url}`
            );
          }
        })
        .then((data) => {
          thisForm.querySelector(".loading").classList.remove("d-block");
          if (data.trim() === "success") {
            thisForm.querySelector(".sent-message").classList.add("d-block");
            thisForm.reset();
          } else {
            throw new Error(data || "Form submission failed!");
          }
        })
        .catch((error) => {
          displayError(thisForm, error.message || "An unknown error occurred.");
        });
    });
  });

  function displayError(thisForm, error) {
    thisForm.querySelector(".loading").classList.remove("d-block");
    thisForm.querySelector(".error-message").innerHTML = error;
    thisForm.querySelector(".error-message").classList.add("d-block");
  }
})();