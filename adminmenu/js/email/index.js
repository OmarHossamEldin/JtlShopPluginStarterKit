window.addEventListener("load", async () => {
    const result = document.querySelector(".results-email-credentials");
    const loading = document.querySelector(".loading-email-credentials");
    const prev = document.querySelector(".prev-email-credentials");
    const next = document.querySelector(".next-email-credentials");
    const popUpContainer = document.querySelector(".pop-up-container.email-credential");
    const popUpContent = document.querySelector(".pop-up-content.email-credential");
    const popUpIcon = document.querySelector(".pop-up-icon.email-credential");
    const popUpMessage = document.querySelector(".pop-up-message.email-credential");
    const popUpConfirm = document.querySelector("#confirm-pop-up-screen.email-credential");
    const form = document.querySelector(".create-email-credentials");  
    const information = await getEmailCredentials();
    drawEmailCredentialsTable(result,prev, next, loading, information, information.data);
    createEmailCredentials(form, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage,popUpConfirm, result, prev, next);
    confirmDeleteEmailCredentials(result, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage, popUpConfirm);
  });
  