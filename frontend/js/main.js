window.onload = () => {

  const basUrl = `${location.protocol}://${location.host}`,
    httpRequest = new HttpRequest(basUrl);

  const postsRequests = httpRequest.get('/ressource', '?fetch=posts');

  postsRequests.then(response => {
    console.log(response)
  });
  // or async await approach

}