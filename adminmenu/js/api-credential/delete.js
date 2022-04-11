let deleteApiCredential = document.querySelectorAll(".delete-api-credential");

deleteApiCredential.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let apiCredentialId = e.target.getAttribute("delete-api-attributes");

    //let token = document.querySelector('.jtl_token').value;

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const deleteApiCredentialFormData = new FormData();
    deleteApiCredentialFormData.set("io", "request");
    deleteApiCredentialFormData.set("jtl_token", token);
    deleteApiCredentialFormData.set("apiCredentialId", apiCredentialId);

    let request = fiber.post("/delete/api-credential", deleteApiCredentialFormData);
    request.then((response) => {
      
      alert(response.data.message)

    });
  });
});
