fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const storeCategoryFormData = new FormData();
  storeCategoryFormData.set("io", "request");
  storeCategoryFormData.set("jtl_token", token);
  
  const categoryForm = document.querySelector(".store-category");
  
  
  categoryForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < categoryForm.elements.length; index++) {
      if (categoryForm.elements[index].type !== "submit") {
        if (!!categoryForm.elements[index].value.trim() !== false) {
          storeCategoryFormData.set(categoryForm.elements[index].name, categoryForm.elements[index].value);
          categoryForm.elements[index].value = "";
        }  else {
          categoryForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/store/category", storeCategoryFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  