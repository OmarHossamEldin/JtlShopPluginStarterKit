//const prev = document.querySelector(".prev-posts");
//const next = document.querySelector(".next-posts");
//const loading = document.querySelector(".loading-posts");
//const result = document.querySelector(".results-posts");

next.addEventListener("click", async () => {
    loading.style.display = "block";
    const page = 1 - -result.dataset.currentPage;
    response = await getPosts(page);
    result.innerHTML = "";
    drawPostsTable(result, prev, next, loading, response, response.data);
    if (page < result.dataset.totalPages) {
      next.style.display = "inline-block";
    } else {
      next.style.display = "none";
    }
    if (result.dataset.currentPage === 1) {
      prev.style.display = "none";
    } else {
      prev.style.display = "inline-block";
    }
  });

  prev.addEventListener("click", async () => {
    loading.style.display = "block";
    const page = result.dataset.currentPage - 1;

    result.innerHTML = "";

    information = await getPosts(page);
     drawPostsTable(result, prev, next, loading, information, information.data);
    if (page < result.dataset.totalPages) {
      next.style.display = "inline-block";
    } else {
      next.style.display = "none";
    }
    if (page === 1) {
      prev.style.display = "none";
    } else {
      prev.style.display = "inline-block";
    }
  });