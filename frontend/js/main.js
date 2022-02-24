const basUrl = `${location.protocol}://${location.host}`,
      httpRequest = new HttpRequest(basUrl);
      httpRequest.get('/point_router');