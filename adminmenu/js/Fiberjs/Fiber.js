class Fiber {
  constructor(baseURL = "") {
    this.baseURL = baseURL;
  }

  set_headers(headers) {
    this.headers = headers;
  }

  get(url) {
    return this.request(url, "GET", data);
  }

  post(url, data = {}) {
    return this.request(url, "POST", data);
  }

  patch(url, data = {}) {
    return this.request(url, "PATCH", data);
  }

  put(url, data = {}) {
    return this.request(url, "PUT", data);
  }

  delete(url) {
    return this.request(url, "DELETE", data);
  }

  async request(url, method, data) {
    try {
      url = this.baseURL + url;
      let response;
      if (method === "POST" || method === "PATCH" || method === "PUT") {
        response = await fetch(url, {
          method,
          headers: this.headers,
          body: data,
        });
      }
      if (method === "GET" || method === "DELETE") {
        response = await fetch(url, {
          method,
          headers: this.headers,
        });
      }
      const responseData = {
        status: response.status,
      };
      switch (responseData.status) {
        case 422:
        case 404:
        case 403:
        case 401:
          responseData.errors = await response.json();
          throw new ResponseException("invalid", responseData);
        case 204:
          break;
        default:
          responseData.data = await response.json();
      }
      return responseData;
    } catch (error) {
      if (error instanceof ResponseException) {
        return error.get_response();
      }
      throw new JsonParseException();
    }
  }
}
