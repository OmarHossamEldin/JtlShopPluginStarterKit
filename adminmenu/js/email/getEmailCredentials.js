const getEmailCredentials= async (page = 1) => {
    //const baseUrl = `${location.protocol}//${location.host}/shop/admin/io.php`;

    const baseUrl = `http://localhost/shop/admin/io.php`;
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
    data.set("page", page);
    const request = await fiber.post(`/get/email-credentials`, data);
    const response = request.data;
    return response;
  };
  