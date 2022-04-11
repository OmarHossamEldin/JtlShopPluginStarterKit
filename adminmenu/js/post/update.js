fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const updatePostFormData = new FormData();
  updatePostFormData.set("io", "request");
  updatePostFormData.set("jtl_token", token);
  
  const postUpdateForm = document.querySelector(".update-post");
  
  
  postUpdateForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < postUpdateForm.elements.length; index++) {
      if (postUpdateForm.elements[index].type !== "submit") {
        if (!!postUpdateForm.elements[index].value.trim() !== false) {
          updatePostFormData.set(postUpdateForm.elements[index].name, postUpdateForm.elements[index].value);
          postUpdateForm.elements[index].value = "";
        }  else {
          postUpdateForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/update/post", updatePostFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  