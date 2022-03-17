class HttpRequest {
  constructor(basUrl = "", headers = { "Content-Type": "application/json" }) {
    this.basUrl = basUrl;
    this.headers = headers;
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
    let response = null;
    switch (method) {
      case "POST":
      case "PATCH":
      case "PUT":
        if (!!data) {
          url = this.basUrl + url;
          response = await fetch(url, {
            method,
            headers: this.headers,
            body: JSON.stringify(data),
          });
        } else {
          console.error("passed data should be not empty object");
        }
        break;
      case "GET":
        url = this.basUrl + url;
        response = await fetch(url, {
          method,
          headers: this.headers,
        });
        break;
      case "DELETE":
        url = this.basUrl + url;
        response = await fetch(url, {
          method,
          headers: this.headers,
        });
        return response;
      default:
        console.error("un support request type");
    }
    return {
      status: response.status,
      data: await response.json(),
    };
  }
}