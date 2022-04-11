let deleteCategory = document.querySelectorAll(".delete-this-category");

deleteCategory.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let categoryId = e.target.getAttribute("delete-category-attributes");

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const deleteCategoryFormData = new FormData();
    deleteCategoryFormData.set("io", "request");
    deleteCategoryFormData.set("jtl_token", token);
    deleteCategoryFormData.set("categoryId", categoryId);

    let request = fiber.post("/delete/category", deleteCategoryFormData);
    request.then((response) => {
      alert(response.data.message);
    });
  });
});
