// start send request [access rescource from backend]
async function sendingRequest(url, method, data) {
  const response = await fetch(
    `${url}?attributeName=${
      data.productName
    }&language=${searchForm.getAttribute("language")}`,
    {
      method: method,
      headers: {
        "Content-Type": "application/json",
      },
    }
  );

  return {
    status: response.status,
    data: await response.json(),
  };
}
// end send request [access rescource from backend]

//
const protocol = window.protocol,
      hostname = window.hostname,
      basUrl = `${protocol}://${hostname}/point_router`;

sendingRequest(basUrl, 'GET', 'test').then(response => console.log(response));
