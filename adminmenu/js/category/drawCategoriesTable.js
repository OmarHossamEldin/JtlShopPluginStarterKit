const drawCategoriesTable = (result, prev, next, loading, response, categories = null,newRow = null) => {
    if (newRow !== null) {
      const trow = document.createElement("tr");
      trow.innerHTML = `<td>${result.childElementCount + 1}</td>
                          <td>${newRow.name}</td>
                          <td>${newRow.description}</td>
                          <td style='display:flex; justify-content: space-evenly;'>
                            </button>
                            <button class='update-categories' meta="${newRow.id}">
                              <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                newRow.id
                              }"></i>
                            </button>
                            <button class='delete-categories' meta="${newRow.id}">
                            <i class="fas fa-trash text-dark tecSee-icon" meta="${
                              newRow.id
                            }"></i>
                            </button>
                          </td>`;
      result.appendChild(trow);
    } else {
      categories.forEach((item) => {
        const trow = document.createElement("tr");
        const trowData = `<td>${categories.indexOf(item) + 1}</td>
                                      <td>${item.name}</td>
                                      <td>${item.description}</td>
                                      <td style='display:flex; justify-content: space-evenly;'>
                                      <button class='update-categories' meta="${item.id}">
                                        <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                          item.id
                                        }"></i>
                                      </button>
                                      <button class='delete-categories' meta="${item.id}">
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
    updateCategory();
    deleteCategory();
  };
  