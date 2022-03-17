let updateCredentialEvent = document.querySelectorAll(".update-credentials");

updateCredentialEvent.forEach((e) => {

    e.addEventListener("click", (e) => {

        e.preventDefault();

        let credentialId = e.target.getAttribute("credential-attributes");

        let pluginUrl = e.target.getAttribute("plugin-url");

        let token = document.querySelector('.jtl_token').value;

        let sentData = { "credential_id": credentialId };

        let headers = {
            Accept: "application/json",
            "Content-Type": "application/json",
            jtlToken: token,
        };

        let url = pluginUrl + 'ressource';
        const basUrl = url + '?fetch=get-credential',
            httpRequest = new HttpRequest(basUrl, headers);

        const postData = httpRequest.post(basUrl, sentData);

        postData.then((data) => {
            let credential = data.data.credential;

            document.getElementById("credentialmodeledit").click();
            document.getElementById("businessAccount").value = credential.business_account;
            document.getElementById("clientId").value = credential.client_id;
            document.getElementById("secretKey").value = credential.secret_key;

        });
    })
})
