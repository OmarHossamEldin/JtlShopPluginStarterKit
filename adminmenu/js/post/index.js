window.addEventListener("load", async () => {
    const result = document.querySelector(".results-posts");
    const loading = document.querySelector(".loading-posts");
    const prev = document.querySelector(".prev-posts");
    const next = document.querySelector(".next-posts");
    const popUpContainer = document.querySelector(".pop-up-container.post");
    const popUpContent = document.querySelector(".pop-up-content.post");
    const popUpIcon = document.querySelector(".pop-up-icon.post");
    const popUpMessage = document.querySelector(".pop-up-message.post");
    const popUpConfirm = document.querySelector("#confirm-pop-up-screen.post");
    const form = document.querySelector(".create-post");  
    const information = await getPosts();
    drawPostsTable(result,prev, next, loading, information, information.data);
    createPost(form, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage,popUpConfirm, result, prev, next);
    confirmDeletePost(result, loading, popUpContainer, popUpContent, popUpIcon, popUpMessage, popUpConfirm);
  });
  