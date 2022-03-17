// start request
async function toggleRequest(method, basUrl, data) {
  let postObject = {
    method: method,
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      jtlToken: `${fetchToken}`,
    },
    body: JSON.stringify({ search: data }),
  };

  let getObject = {
    method: method,
    headers: {
      "Content-Type": "application/json",
      jtlToken: `${fetchToken}`,
    },
  };

  const response = await fetch(
    basUrl,
    method === "POST" ? postObject : getObject
  );

  // return content;
  return response;
}
// end request
