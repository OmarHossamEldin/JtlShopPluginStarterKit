fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  
  const storePostFormData = new FormData();
  storePostFormData.set("io", "request");
  storePostFormData.set("jtl_token", token);
  
  const postForm = document.querySelector(".store-post");
  
  
  postForm.addEventListener("submit", async (event) => {
    event.preventDefault();
  
    for (index = 0; index < postForm.elements.length; index++) {
      if (postForm.elements[index].type !== "submit") {
        if (!!postForm.elements[index].value.trim() !== false) {
          storePostFormData.set(postForm.elements[index].name, postForm.elements[index].value);
          postForm.elements[index].value = "";
        }  else {
          postForm.elements[index].classList.add("tecSee-invalid");
        }
      }
    }
  
    let request = fiber.post("/store/post", storePostFormData);
    request.then((response) => {
      console.log(response);
      console.log("Created successfully");
    }
    );
  
  });
  