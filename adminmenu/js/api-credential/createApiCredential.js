const createApiCredential = (form,loading, popUpContainer,popUpContent,popUpIcon,popUpMessage,popUpConfirm,result, prev, next) => {
  //const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

  const fiber = new Fiber(baseUrl);
  const token = document.querySelector(".jtl_token").value;

  fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });

  const data = new FormData();
  data.set("io", "request");
  data.set("jtl_token", token);



  form.addEventListener("submit", async (event) => {
    event.preventDefault();
    loading.style.display = "block";
    for (index = 0; index < form.elements.length; index++) {
      if (form.elements[index].type !== "submit") {
        if (!!form.elements[index].value.trim() !== false) {
          data.set(form.elements[index].name, form.elements[index].value);
          form.elements[index].classList.remove("tecSee-invalid");
          form.elements[index].value = "";
        } else {
          form.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
    const response = await fiber.post("/admin/io.php/api-credentials", data);
    loading.style.display = "none";
    popUpMessage.innerHTML = "";
    popUpConfirm.classList.add('hidden')
    if (response.status === 422) {
      popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/exclamation-mark.png`;
      response.errors.forEach((error) => {
        const paragraph = document.createElement("p");
        for (const key in error) {
          paragraph.innerHTML = `${key}: ${error[key]}`;
        }
        popUpMessage.appendChild(paragraph);
      });
    } else {
      popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/accept.png`;
      const paragraph = document.createElement("p");
      paragraph.innerHTML = response.data.message;
      popUpMessage.appendChild(paragraph);
      const api_credential = { ...response.data.api_credential };
      if (result.childElementCount < result.dataset.resultPerPage) {
        drawApiCredentialsTable(result, prev, next, loading, response, null, api_credential);
      } else {
        const next = document.querySelector(".next-api-credentials");
        next.style.display = "inline-block";
      }
    }
    popUpContainer.classList.add("active");
    popUpContent.classList.add("active");
  });

  const popUpClose = document.querySelector(".dismiss-popup.api-credential");
  popUpClose.addEventListener("click", () => {
    popUpContainer.classList.remove("active");
    popUpContent.classList.remove("active");
  });
  
};
