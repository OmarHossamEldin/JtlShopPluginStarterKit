


fiber.set_headers({
  "Content-lang": "en",
  Accept: "application/json",
  "Jtl-Token": token,
});

const data = new FormData();
data.set("io", "request");
data.set("jtl_token", token);

const form = document.querySelector(".store-email-credentials");


form.addEventListener("submit", async (event) => {
  event.preventDefault();

  for (index = 0; index < form.elements.length; index++) {
    if (form.elements[index].type !== "submit") {
      if (!!form.elements[index].value.trim() !== false) {
        data.set(form.elements[index].name, form.elements[index].value);
        form.elements[index].value = "";
      } /* else {
        form.elements[index].classList.add("tecSee-invalid");
      } */
    }
  }

  let request = fiber.post("/store/email-credentials", data);
  request.then((response) => {
    console.log(response);
    console.log("Created successfully");
  }
  );

});








