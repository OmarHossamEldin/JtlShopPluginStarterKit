const deleteEmailCredentials = () => {
  //const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

  const popUpContainer = document.querySelector(".pop-up-container.email-credential");
  const popUpContent = document.querySelector(".pop-up-content.email-credential");
  const popUpIcon = document.querySelector(".pop-up-icon.email-credential");
  const popUpMessage = document.querySelector(".pop-up-message.email-credential");
  const popUpConfirm = document.querySelector("#confirm-pop-up-screen.email-credential");
  deleteIcons = document.querySelectorAll(".delete-categories");

  deleteIcons.forEach((deleteIcon) => {
    deleteIcon.addEventListener("click", () => {
      popUpIcon.src = `${baseUrl}/mediafiles/Resources/images/warning.png`;
      const paragraph = document.createElement("p");
      paragraph.innerHTML =
        "Are You Sure You Want to Delete This, you want be Able to retrieve it again?";
      popUpMessage.innerHTML = paragraph.innerHTML;
      popUpConfirm.classList.remove("hidden");
      popUpConfirm.dataset.meta = deleteIcon.getAttribute("meta");
      popUpContainer.classList.add("active");
      popUpContent.classList.add("active");
    });
  });
};
