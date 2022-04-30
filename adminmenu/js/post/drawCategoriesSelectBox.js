const drawCategoriesSelectBox = async () => {
  //  const baseUrl = `${location.protocol}//${location.host}/shop/admin/io.php`;
  const baseUrl = `http://localhost/shop/admin/io.php`;

  const fiber = new Fiber(baseUrl);
  const token = document.querySelector(".jtl_token").value;
  let selectedLang =
    document.querySelector(".fa-language").nextSibling.nextSibling.innerHTML;
  selectedLang = selectedLang === "English" ? "en" : "de";

  fiber.set_headers({
    "Content-lang": selectedLang,
    Accept: "application/json",
    "Jtl-Token": token,
  });
  const data = new FormData();
  data.set("io", "request");
  data.set("jtl_token", token);
  const response = await fiber.post(`/get/categories/all`, data);

  response.data.forEach((category) => {
    const option = new Option(category.name, category.id);
    const selectType = document.querySelector(".input-post-category");
    selectType.options.add(option, undefined);
  });
};
