window.addEventListener("load", async () => {
    const result = document.querySelector(".results-categories");
    const loading = document.querySelector(".loading-categories");
    const prev = document.querySelector(".prev-categories");
    const next = document.querySelector(".next-categories");
    const popUpContainer = document.querySelector(".pop-up-container.category");
    const popUpContent = document.querySelector(".pop-up-content.category");
    const popUpIcon = document.querySelector(".pop-up-icon.category");
    const popUpMessage = document.querySelector(".pop-up-message.category");
    const popUpConfirm = document.querySelector("#confirm-pop-up-screen.category");
    const form = document.querySelector(".create-category");  
    const information = await getCategories();
    drawCategoriesTable(result,prev, next, loading, information, information.data);
    createCategory(form, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage,popUpConfirm, result, prev, next);
    confirmDeleteCategory(result, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage, popUpConfirm);
  });
  