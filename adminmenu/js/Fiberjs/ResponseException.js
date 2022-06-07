class ResponseException extends Error {
  constructor(message, response) {
    super(message);
    this.response = { ...response };
    this.name = "ResponseException";
  }

  get_response() {
    return this.response;
  }
}
