/* const prev = document.querySelector(".prev-email-credentials");
const next = document.querySelector(".next-email-credentials");
const loading = document.querySelector(".loading-email-credentials");
const result = document.querySelector(".results-email-credentials"); */

next.addEventListener("click", async () => {
    loading.style.display = "block";
    const page = 1 - -result.dataset.currentPage;
    response = await getEmailCredentials(page);
    result.innerHTML = "";
    drawEmailCredentialsTable(result, prev, next, loading, response, response.data);
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

    information = await getEmailCredentials(page);
     drawEmailCredentialsTable(result, prev, next, loading, information, information.data);
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