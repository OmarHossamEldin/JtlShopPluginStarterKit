let updateCategory = document.querySelectorAll(".update-this-category");

updateCategory.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let categoryId = e.target.getAttribute("category-attributes");

    //let token = document.querySelector('.jtl_token').value;

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const getCategoryFormData = new FormData();
    getCategoryFormData.set("io", "request");
    getCategoryFormData.set("jtl_token", token);
    getCategoryFormData.set("categoryId", categoryId);

    let request = fiber.post("/get/category", getCategoryFormData);
    request.then((response) => {
      let category = response.data.category;

      document.getElementById("categoryeditmodal").click();
      document.getElementById("categoryId").value = category.id;
      document.getElementById("category-title").value = category.name;
      document.getElementById("category-description").textContent = category.description;
    });
  });
});
