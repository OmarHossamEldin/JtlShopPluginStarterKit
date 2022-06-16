const drawApiCredentialsTable = (result, prev, next, loading, response, api_credentials = null,newRow = null) => {
    if (newRow !== null) {
      const trow = document.createElement("tr");
      trow.innerHTML = `<td>${result.childElementCount + 1}</td>
                          <td>${newRow.business_account}</td>
                          <td>${newRow.client_id}</td>
                          <td>${newRow.secret_key}</td>
                          <td style='display:flex; justify-content: space-evenly;'>
                            </button>
                            <button class='update-api-credentials ' meta="${newRow.id}">
                              <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                newRow.id
                              }"></i>
                            </button>
                            <button class='delete-api-credentials ' meta="${newRow.id}">
                            <i class="fas fa-trash text-dark tecSee-icon" meta="${
                              newRow.id
                            }"></i>
                            </button>
                          </td>`;
      result.appendChild(trow);
    } else {
      api_credentials.forEach((item) => {
        const trow = document.createElement("tr");
        const trowData = `<td>${api_credentials.indexOf(item) + 1}</td>
                                      <td>${item.business_account}</td>
                                      <td>${item.client_id}</td>
                                      <td>${item.secret_key}</td>
                                      <td style='display:flex; justify-content: space-evenly;'>
                                      <button class='update-api-credentials' meta="${item.id}">
                                        <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                          item.id
                                        }"></i>
                                      </button>
                                      <button class='delete-api-credentials' meta="${item.id}">
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
    updateApiCredential();
    deleteApiCredential();
  };
  