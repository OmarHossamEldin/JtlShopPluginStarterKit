const confirmDeletePost = (result, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage, popUpConfirm) => {
 // const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

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
  popUpConfirm.onclick =  async () => {
    popUpContainer.classList.remove("active");
    popUpContent.classList.remove("active");
    loading.style.display = "block";
    const id = popUpConfirm.dataset.meta;
    const response = await fiber.post(`/admin/io.php/delete/posts/${id}`, data);
    loading.style.display = "none";
    if (response === 204) {
      popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/accept.png`;
      const paragraph = document.createElement("p");
      paragraph.innerHTML = "Post Deleted Successfully";
      popUpMessage.innerHTML = paragraph.innerHTML;
      
      const filtered = [];
      for (const key in result.children) {
        const trow = result.children[key];
        if(typeof trow.lastElementChild !== 'undefined'){
            if(id !== trow.lastElementChild.lastElementChild.getAttribute("meta" )){
                filtered.push(trow);
            }
        }
      }
      result.innerHTML = "";
      filtered.forEach((dataRow) => {
        if (typeof dataRow === "object") {
          result.append(dataRow);
        }
      });
    } else if (response === 422) {
      popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/exclamation-mark.png`;
      const paragraph = document.createElement("p");
      paragraph.innerHTML =
        "Please Make Sure Selected Post!!";
      popUpMessage.innerHTML = paragraph.innerHTML;
    }
    popUpConfirm.classList.add("hidden");
    popUpContainer.classList.add("active");
    popUpContent.classList.add("active");
  };

  const popUpClose = document.querySelector(".dismiss-popup.category");
  popUpClose.addEventListener("click", () => {
    popUpContainer.classList.remove("active");
    popUpContent.classList.remove("active");
  });
};
