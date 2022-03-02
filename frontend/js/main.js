const basUrl = `${location.protocol}://${location.host}`,
      httpRequest = new HttpRequest(basUrl);
      httpRequest.get('/ressource','?fetch=posts');