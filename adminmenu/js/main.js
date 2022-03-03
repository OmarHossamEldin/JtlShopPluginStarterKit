const basUrl = `${location.protocol}://${location.host}`,
      httpRequest = new HttpRequest(basUrl);
      httpRequest.post('/ressource','?fetch=posts');