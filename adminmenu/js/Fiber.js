class Fiber {
  constructor(baseURL = "") {
    this.baseURL = baseURL;
  }

  set_headers(headers) {
    this.headers = headers;
  }

  get(url, data = "") {
    return this.request(url, "GET", data);
  }

  post(url, data = "") {
    return this.request(url, "POST", data);
  }

  patch(url, data = "") {
    return this.request(url, "PATCH", data);
  }

  put(url, data = "") {
    return this.request(url, "PUT", data);
  }

  delete(url, data = "") {
    return this.request(url, "DELETE", data);
  }

  async request(url, method, data) {
    url = this.baseURL + url;
    let response = null;
    switch (method) {
      case "POST":
      case "PATCH":
      case "PUT":
        if ((typeof data === 'object') && (!!data)) {
          response = await fetch(url, {
            method,
            headers: this.headers,
            body: data,
          });
        } else if (!!data === false) {
          response = await fetch(url, {
            method,
            headers: this.headers
          });
        } else {
          console.error("passed data should be not empty object");
        }
        break;
      case "GET":
        response = await fetch(url, {
          method,
          headers: this.headers,
        });
        break;
      case "DELETE":
        response = await fetch(url, {
          method,
          headers: this.headers,
        });
        return response;
      default:
        console.error("un support request type");
    }
    return response.status === 204 ? response.status : {
      status: response.status,
      data: await response.json(),
    };
  }
}
