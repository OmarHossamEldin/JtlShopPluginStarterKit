const updatePost = () => {
  const updateIcons = document.querySelectorAll(".update-posts");
  const openModel = document.querySelector(".open-update-post-model");
  const closeModel = document.querySelector('.close.post');
  const form = document.querySelector(".update-post-form");
  //const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

  const fiber = new Fiber(baseUrl);
  const token = document.querySelector(".jtl_token").value;
  const popUpContainer = document.querySelector(".pop-up-container.post");
  const popUpContent = document.querySelector(".pop-up-content.post");
  const popUpIcon = document.querySelector(".pop-up-icon.post");
  const popUpMessage = document.querySelector(".pop-up-message.post");
  const loading = document.querySelector(".loading-posts");
  const popUpConfirm = document.querySelector("#confirm-pop-up-screen.post");
  const result = document.querySelector(".results-posts");

  fiber.set_headers({
    "Content-lang": "en",
    Accept: "application/json",
    "Jtl-Token": token,
  });
  const data = new FormData();
  data.set("io", "request");
  data.set("jtl_token", token);

  updateIcons.forEach((updateIcon) => {

    updateIcon.onclick = () => {
      const id = updateIcon.getAttribute("meta");
      const trow = updateIcon.parentElement.parentElement;
      const title = trow.children[1].textContent;
      const body = trow.children[2].textContent;
      const quantity = trow.children[4].textContent;

      form.elements[0].value = title;
      form.elements[1].value = body;  
      form.elements[3].value = quantity;  


      openModel.click();

      form.onsubmit = async (event) => {
        event.preventDefault();
        let submit = false;
        for (index = 0; index < form.elements.length; index++) {
          if (form.elements[index].type !== "submit") {
            if (!!form.elements[index].value.trim() !== false) {
              data.set(form.elements[index].name, form.elements[index].value);
              form.elements[index].classList.remove("tecSee-invalid");
              submit = true;
            } else {
              form.elements[index].classList.add("tecSee-invalid");
              submit = false;
            }
          }
        }
        if (submit) {
          const response = await fiber.post(`/admin/io.php/update/posts/${id}`, data);
          loading.style.display = "none";
          popUpMessage.innerHTML = "";
          popUpConfirm.classList.add("hidden");
          if (response.status === 422) {
            popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/exclamation-mark.png`;
            response.errors.forEach((error) => {
              const paragraph = document.createElement("p");
              for (const key in error) {
                paragraph.innerHTML = `${key}: ${error[key]}`;
              }
              popUpMessage.appendChild(paragraph);
            });
          } else {
            popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/accept.png`;
            const paragraph = document.createElement("p");
            paragraph.innerHTML = response.data.message;
            popUpMessage.appendChild(paragraph);
            closeModel.click();
            for (const key in result.children) {
                const trow = result.children[key];
                if(typeof trow.lastChild !== 'undefined'){
                    if(trow.lastChild.children[1].getAttribute('meta') === id){
                        trow.lastChild.children[1].setAttribute('meta', id);
                         trow.children[1].textContent = response.data.category.title
                        trow.children[2].textContent = response.data.category.body
                    }
                }
            }
          }
          popUpContainer.classList.add("active");
          popUpContent.classList.add("active");
        }
      };
    };
  });
};
