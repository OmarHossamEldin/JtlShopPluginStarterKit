window.addEventListener("load", async () => {
    const result = document.querySelector(".results-api-credentials");
    const loading = document.querySelector(".loading-api-credentials");
    const prev = document.querySelector(".prev-api-credentials");
    const next = document.querySelector(".next-api-credentials");
    const popUpContainer = document.querySelector(".pop-up-container.api-credential");
    const popUpContent = document.querySelector(".pop-up-content.api-credential");
    const popUpIcon = document.querySelector(".pop-up-icon.api-credential");
    const popUpMessage = document.querySelector(".pop-up-message.api-credential");
    const popUpConfirm = document.querySelector("#confirm-pop-up-screen.api-credential");
    const form = document.querySelector(".create-api-credential");  
    const information = await getApiCredential();
    drawApiCredentialsTable(result,prev, next, loading, information, information.data);
    createApiCredential(form, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage,popUpConfirm, result, prev, next);
    confirmDeleteApiCredential(result, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage, popUpConfirm);
  });
  