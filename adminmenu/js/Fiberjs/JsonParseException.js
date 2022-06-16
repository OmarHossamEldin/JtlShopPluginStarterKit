class JsonParseException extends Error {
  constructor() {
    super("Not Valid Json Format");
    this.name = "JsonParseException";
  }
}
