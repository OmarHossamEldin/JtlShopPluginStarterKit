const deleteCategory = () => {
  //const baseUrl = `${location.protocol}//${location.host}/shop`;
  const baseUrl = `http://localhost/shop`;

  const popUpContainer = document.querySelector(".pop-up-container.category");
  const popUpContent = document.querySelector(".pop-up-content.category");
  const popUpIcon = document.querySelector(".pop-up-icon.category");
  const popUpMessage = document.querySelector(".pop-up-message.category");
  const popUpConfirm = document.querySelector("#confirm-pop-up-screen.category");
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
