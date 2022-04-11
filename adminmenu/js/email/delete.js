let deleteEmailCredentials = document.querySelectorAll(".delete-email-credentials");

deleteEmailCredentials.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let emailCredentialId = e.target.getAttribute("email-credentials-attributes");

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const deleteEmailCredentialsFormData = new FormData();
    deleteEmailCredentialsFormData.set("io", "request");
    deleteEmailCredentialsFormData.set("jtl_token", token);
    deleteEmailCredentialsFormData.set("emailCredentialId", emailCredentialId);

    let request = fiber.post("/delete/email-credential", deleteEmailCredentialsFormData);
    request.then((response) => {
      alert(response.data.message);
    });
  });
});
