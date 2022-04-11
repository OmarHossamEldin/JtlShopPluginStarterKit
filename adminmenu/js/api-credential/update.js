fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const updateApiCredentialsFormData = new FormData();
  updateApiCredentialsFormData.set("io", "request");
  updateApiCredentialsFormData.set("jtl_token", token);
  
  const apiCredentialsUpdateForm = document.querySelector(".update-api-credential");
  
  
  apiCredentialsUpdateForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < apiCredentialsUpdateForm.elements.length; index++) {
      if (apiCredentialsUpdateForm.elements[index].type !== "submit") {
        if (!!apiCredentialsUpdateForm.elements[index].value.trim() !== false) {
          updateApiCredentialsFormData.set(apiCredentialsUpdateForm.elements[index].name, apiCredentialsUpdateForm.elements[index].value);
          apiCredentialsUpdateForm.elements[index].value = "";
        }  else {
          apiCredentialsUpdateForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/update/api-credential", updateApiCredentialsFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  