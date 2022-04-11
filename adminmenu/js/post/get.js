let updatePost = document.querySelectorAll(".update-this-post");

updatePost.forEach((e) => {
  e.addEventListener("click", (e) => {
    e.preventDefault();

    let postId = e.target.getAttribute("date-attributes");

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

    let request = fiber.post("/get/post", formData);
    request.then((response) => {
      let post = response.data.post;

      document.getElementById("posteditmodal").click();
      document.getElementById("postId").value = post.id;
      document.getElementById("post-title").value = post.title;
      document.getElementById("post-body").textContent = post.body;

      var category = document.getElementById("category-name");
      category.value = post.tec_see_category_id;
      category.options[category.options.selectedIndex].setAttribute("selected", "selected");

    });
  });
});
