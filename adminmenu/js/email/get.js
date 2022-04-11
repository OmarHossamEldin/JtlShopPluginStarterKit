let updateEmailCredentials = document.querySelectorAll(".update-email-credentials");

updateEmailCredentials.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let emailCredentialId = e.target.getAttribute("email-attributes");

    //let token = document.querySelector('.jtl_token').value;

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const getEmailCredentialsFormData = new FormData();
    getEmailCredentialsFormData.set("io", "request");
    getEmailCredentialsFormData.set("jtl_token", token);
    getEmailCredentialsFormData.set("emailCredentialId", emailCredentialId);

    let request = fiber.post("/get/email-credential", getEmailCredentialsFormData);
    request.then((response) => {
      let emailCredential = response.data.emailCredential;

      document.getElementById("emailcredentialmodeledit").click();
      document.getElementById("emailCredentialId").value = emailCredential.id;
      document.getElementById("email-address").value = emailCredential.email;
      document.getElementById("mail-host").value = emailCredential.mail_host;
      document.getElementById("username").value = emailCredential.username;
      document.getElementById("password").value = emailCredential.password;
      document.getElementById("port").value = emailCredential.port;

    });
  });
});
