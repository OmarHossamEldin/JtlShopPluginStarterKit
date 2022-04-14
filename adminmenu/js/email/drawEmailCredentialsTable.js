const drawEmailCredentialsTable = (result, prev, next, loading, response, emailCredentials = null,newRow = null) => {
    if (newRow !== null) {
      const trow = document.createElement("tr");
      trow.innerHTML = `<td>${result.childElementCount + 1}</td>
                          <td>${newRow.email}</td>
                          <td>${newRow.mail_host}</td>
                          <td>${newRow.username}</td>
                          <td>${newRow.password}</td>
                          <td>${newRow.port}</td>
                          <td style='display:flex; justify-content: space-evenly;'>
                            </button>
                            <button class='update-email-credentials' meta="${newRow.id}">
                              <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                newRow.id
                              }"></i>
                            </button>
                            <button class='delete-email-credentials' meta="${newRow.id}">
                            <i class="fas fa-trash text-dark tecSee-icon" meta="${
                              newRow.id
                            }"></i>
                            </button>
                          </td>`;
      result.appendChild(trow);
    } else {
      emailCredentials.forEach((item) => {
        const trow = document.createElement("tr");
        const trowData = `<td>${emailCredentials.indexOf(item) + 1}</td>
                                      <td>${item.email}</td>
                                      <td>${item.mail_host}</td>
                                      <td>${item.username}</td>
                                      <td>${item.password}</td>
                                      <td>${item.port}</td>

                                      <td style='display:flex; justify-content: space-evenly;'>
                                      <button class='update-email-credentials' meta="${item.id}">
                                        <i class="fas fa-edit text-dark tecSee-icon" meta="${
                                          item.id
                                        }"></i>
                                      </button>
                                      <button class='delete-email-credentials' meta="${item.id}">
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
    updateEmailCredentials();
    deleteEmailCredentials();
  };
  