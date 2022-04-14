window.addEventListener("load", async () => {
    const loading = document.querySelector(".loading-test-email");
    const popUpContainer = document.querySelector(".pop-up-container.test-email");
    const popUpContent = document.querySelector(".pop-up-content.test-email");
    const popUpIcon = document.querySelector(".pop-up-icon.test-email");
    const popUpMessage = document.querySelector(".pop-up-message.test-email");
    const popUpConfirm = document.querySelector("#confirm-pop-up-screen.test-email");
    const form = document.querySelector(".send-test-email");  
    SendTestEmail(form, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage,popUpConfirm);
  });
  