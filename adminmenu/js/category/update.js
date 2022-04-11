fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const updateCategoryFormData = new FormData();
  updateCategoryFormData.set("io", "request");
  updateCategoryFormData.set("jtl_token", token);
  
  const categoryUpdateForm = document.querySelector(".update-category");
  
  
  categoryUpdateForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < categoryUpdateForm.elements.length; index++) {
      if (categoryUpdateForm.elements[index].type !== "submit") {
        if (!!categoryUpdateForm.elements[index].value.trim() !== false) {
          updateCategoryFormData.set(categoryUpdateForm.elements[index].name, categoryUpdateForm.elements[index].value);
          categoryUpdateForm.elements[index].value = "";
        }  else {
          categoryUpdateForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/update/category", updateCategoryFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  