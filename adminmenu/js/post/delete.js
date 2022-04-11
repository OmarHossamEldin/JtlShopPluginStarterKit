let deletePost = document.querySelectorAll(".delete-this-post");

deletePost.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let postId = e.target.getAttribute("delete-post-attributes");

    //let token = document.querySelector('.jtl_token').value;

    fiber.set_headers({
      "Content-lang": "en",
      Accept: "application/json",
      "Jtl-Token": token,
    });

    const formData = new FormData();
    formData.set("io", "request");
    formData.set("jtl_token", token);
    formData.set("postId", postId);

    let request = fiber.post("/delete/post", formData);
    request.then((response) => {
      
      alert(response.data.message)

    });
  });
});
