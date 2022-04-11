let updateApiCredentials = document.querySelectorAll(".update-api-credentials");

updateApiCredentials.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let apiCredentialId = e.target.getAttribute("api-attributes");

    //let token = document.querySelector('.jtl_token').value;

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const getApiCredentialsFormData = new FormData();
    getApiCredentialsFormData.set("io", "request");
    getApiCredentialsFormData.set("jtl_token", token);
    getApiCredentialsFormData.set("apiCredentialId", apiCredentialId);

    let request = fiber.post("/get/api-credential", getApiCredentialsFormData);
    request.then((response) => {
      let credential = response.data.credential;

      document.getElementById("credentialmodeledit").click();
      document.getElementById("credentialId").value = credential.id;
      document.getElementById("businessAccount").value = credential.business_account;
      document.getElementById("clientId").value = credential.client_id;
      document.getElementById("secretKey").value = credential.secret_key;
    });
  });
});
