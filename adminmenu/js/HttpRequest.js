class HttpRequest {
  constructor(basUrl = "", headers = { "Content-Type": "application/json" }) {
    this.basUrl = basUrl;
    this.headers = headers;
  }

  set_headers(headers) {
    this.headers = headers;
  }
  get(url, data = {}) {
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
  delete(url, data = {}) {
    return this.request(url, "DELETE", data);
  }
  async request(url, method, data) {
    let response = null;
    switch (method) {
      case "POST":
      case "PATCH":
      case "PUT":
      case "DELETE":
        response = await fetch(url, {
          method,
          headers: this.headers,
          body: JSON.stringify(data),
        });
        return {
          status: response.status,
          data: await response.json(),
        };
      case "GET":
        url = data !== {} ? url + data : url;
        response = await fetch(url, {
          method,
          headers: this.headers,
        });
        return {
          status: response.status,
          data: await response.json(),
        };
      default:
        return "un support request type";
    }
  }
}
