const updateEmailCredentials = () => {
  const updateIcons = document.querySelectorAll(".update-email-credentials");
  const openModel = document.querySelector(".open-update-email-credential-model");
  const closeModel = document.querySelector('.close.email-credential');
  const form = document.querySelector(".update-email-credential-form");
  //const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

  const fiber = new Fiber(baseUrl);
  const token = document.querySelector(".jtl_token").value;
  const popUpContainer = document.querySelector(".pop-up-container.email-credential");
  const popUpContent = document.querySelector(".pop-up-content.email-credential");
  const popUpIcon = document.querySelector(".pop-up-icon.email-credential");
  const popUpMessage = document.querySelector(".pop-up-message.email-credential");
  const loading = document.querySelector(".loading-email-credentials");
  const popUpConfirm = document.querySelector("#confirm-pop-up-screen.email-credential");
  const result = document.querySelector(".results-email-credentials");

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
       const email = trow.children[1].textContent;
      const mail_host = trow.children[2].textContent;
      const username = trow.children[3].textContent;
      const password = trow.children[4].textContent;
      const port = trow.children[5].textContent;

      form.elements[0].value = email;
      form.elements[1].value = mail_host; 
      form.elements[2].value = username; 
      form.elements[3].value = password; 
      form.elements[4].value = port; 


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
          const response = await fiber.post(`/admin/io.php/update/email-credentials/${id}`, data);
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
                         trow.children[1].textContent = response.data.emailCredentials.email
                        trow.children[2].textContent = response.data.emailCredentials.mail_host
                        trow.children[3].textContent = response.data.emailCredentials.username
                        trow.children[4].textContent = response.data.emailCredentials.password
                        trow.children[5].textContent = response.data.emailCredentials.port
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
