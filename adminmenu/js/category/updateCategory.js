const updateCategory = () => {
  const updateIcons = document.querySelectorAll(".update-categories");
  const openModel = document.querySelector(".open-update-category-model");
  const closeModel = document.querySelector('.close.category');
  const form = document.querySelector(".update-category-form");
  //const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

  const fiber = new Fiber(baseUrl);
  const token = document.querySelector(".jtl_token").value;
  const popUpContainer = document.querySelector(".pop-up-container.category");
  const popUpContent = document.querySelector(".pop-up-content.category");
  const popUpIcon = document.querySelector(".pop-up-icon.category");
  const popUpMessage = document.querySelector(".pop-up-message.category");
  const loading = document.querySelector(".loading-categories");
  const popUpConfirm = document.querySelector("#confirm-pop-up-screen.category");
  const result = document.querySelector(".results-categories");

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
       const name = trow.children[1].textContent;
      const description = trow.children[2].textContent;
      form.elements[0].value = name;
      form.elements[1].value = description; 

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
          const response = await fiber.post(`/admin/io.php/update/categories/${id}`, data);
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
                         trow.children[1].textContent = response.data.category.name
                        trow.children[2].textContent = response.data.category.description
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
