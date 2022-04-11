//const baseUrl = `${location.protocol}//${location.host}/Admin/io.php`;
const baseUrl = `http://localhost/shop-v5/io.php`;
const fiber = new Fiber(baseUrl);
const token = document.querySelector(".jtl_token").value;

fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const storeApiCredentialsFormData = new FormData();
  storeApiCredentialsFormData.set("io", "request");
  storeApiCredentialsFormData.set("jtl_token", token);
  
  const apiCredentialsForm = document.querySelector(".store-api-credential");
  
  
  apiCredentialsForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < apiCredentialsForm.elements.length; index++) {
      if (apiCredentialsForm.elements[index].type !== "submit") {
        if (!!apiCredentialsForm.elements[index].value.trim() !== false) {
          storeApiCredentialsFormData.set(apiCredentialsForm.elements[index].name, apiCredentialsForm.elements[index].value);
         // apiCredentialsForm.elements[index].value = "";
        }  else {
          apiCredentialsForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/store/api-credential", storeApiCredentialsFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  