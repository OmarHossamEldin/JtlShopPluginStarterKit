
//const baseUrlPath = `${location.protocol}//${location.host}/Admin/io.php`;
 const baseUrlPath = `http://localhost/shop-v5/io.php`;
const fiberClass = new Fiber(baseUrlPath); 
const tokenValue = document.querySelector(".jtl_token").value;


fiberClass.set_headers({
  "Content-lang": "en",
  Accept: "application/json",
  "Jtl-Token": tokenValue,
});

const testMailData = new FormData();
testMailData.set("io", "request");
testMailData.set("jtl_token", tokenValue);

const testMailForm = document.querySelector(".send-test-email");


testMailForm.addEventListener("submit", async (event) => {
  event.preventDefault();

  for (index = 0; index < testMailForm.elements.length; index++) {
    if (testMailForm.elements[index].type !== "submit") {
      if (!!testMailForm.elements[index].value.trim() !== false) {
        testMailData.set(testMailForm.elements[index].name, testMailForm.elements[index].value);
        form.elements[index].classList.remove("tecSee-invalid");
        testMailForm.elements[index].value = "";
      } else {
        testMailForm.elements[index].classList.add("tecSee-invalid");
      }
    }
  }

  let request = fiberClass.post("/test/email", testMailData);
  request.then((response) => { console.log(response); }
  );

});







