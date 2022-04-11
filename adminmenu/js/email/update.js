fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const updateEmailCredentialsFormData = new FormData();
  updateEmailCredentialsFormData.set("io", "request");
  updateEmailCredentialsFormData.set("jtl_token", token);
  
  const emailCredentialsUpdateForm = document.querySelector(".update-api-credential");
  
  
  emailCredentialsUpdateForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < emailCredentialsUpdateForm.elements.length; index++) {
      if (emailCredentialsUpdateForm.elements[index].type !== "submit") {
        if (!!emailCredentialsUpdateForm.elements[index].value.trim() !== false) {
          updateEmailCredentialsFormData.set(emailCredentialsUpdateForm.elements[index].name, emailCredentialsUpdateForm.elements[index].value);
          emailCredentialsUpdateForm.elements[index].value = "";
        }  else {
          emailCredentialsUpdateForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/update/email-credential", updateEmailCredentialsFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  