const drawPostsTable = (
  result,
  prev,
  next,
  loading,
  response,
  posts = null,
  newRow = null
) => {
  if (newRow !== null) {
    const trow = document.createElement("tr");
    trow.innerHTML = `<td>${result.childElementCount + 1}</td>
                          <td>${newRow.title}</td>
                          <td>${newRow.body}</td>
                          <td>${newRow.category}</td>
                          <td>${newRow.quantity}</td>
                          <td style='display:flex; justify-content: space-evenly;'>
                            </button>
                            <button class='update-posts' meta="${newRow.id}">
                              <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                newRow.id
                              }"></i>
                            </button>
                            <button class='delete-posts' meta="${newRow.id}">
                            <i class="fas fa-trash text-dark tecSee-icon" meta="${
                              newRow.id
                            }"></i>
                            </button>
                          </td>`;
    result.appendChild(trow);
  } else {
    posts.forEach((item) => {
      const trow = document.createElement("tr");
      const trowData = `<td>${posts.indexOf(item) + 1}</td>
                                      <td>${item.title}</td>
                                      <td>${item.body}</td>
                                      <td>${item.category}</td>
                                      <td>${item.quantity}</td>
                                      <td style='display:flex; justify-content: space-evenly;'>
                                      <button class='update-posts' meta="${
                                        item.id
                                      }">
                                        <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                          item.id
                                        }"></i>
                                      </button>
                                      <button class='delete-posts' meta="${
                                        item.id
                                      }">
                                      <i class="fas fa-trash text-dark tecSee-icon" meta="${
                                        item.id
                                      }"></i>
                                      </button>
                                      </td>`;
      trow.innerHTML = trowData;

      result.innerHTML += trow.innerHTML;
      result.dataset.totalPages = response.totalPages;
      result.dataset.currentPage = response.currentPage;
      result.dataset.resultPerPage = response.resultPerPage;
      loading.style.display = "none";
    });
    if (response.nextPage !== "") {
      next.style.display = "inline-block";
    }
  }
  updatePost();
  deletePost();
};
