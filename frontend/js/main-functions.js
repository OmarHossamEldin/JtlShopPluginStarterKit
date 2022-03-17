// start build element
function elementBuilder(
  elementName,
  elementAttribute,
  contentType,
  elementContent,
  elementNumber,
  parentElement
) {
  // start main function to build element
  function mainWork(childElement) {
    for (let index = 0; index < elementAttribute.length; index++) {
      let objectKeys = Object.keys(elementAttribute[index]);
      let objectValues = Object.values(elementAttribute[index]);

      for (let keyNumber = 0; keyNumber < objectKeys.length; keyNumber++) {
        childElement.setAttribute(
          objectKeys[keyNumber],
          objectValues[keyNumber]
        );
      }
    }

    if (contentType === "innerHTML") {
      childElement.innerHTML = elementContent;
    } else if (contentType === "value") {
      childElement.value = elementContent;
    } else if (contentType === "textContent") {
      childElement.textContent = elementContent;
    }
  }
  // end main function to build element

  if (parentElement.length > 1) {
    parentElement.forEach((e) => {
      for (let index = 0; index < elementNumber; index++) {
        let childElement = document.createElement(elementName);

        mainWork(childElement);

        if (!!parentElement) {
          appendElement(e, childElement);
        }
      }
    });
  } else {
    for (let index = 0; index < elementNumber; index++) {
      let childElement = document.createElement(elementName);

      mainWork(childElement);

      if (!!parentElement) {
        appendElement(parentElement, childElement);
      }
    }
  }
}
// end build element

// ========================================

// start append function
function appendElement(parentElement, childElement) {
  parentElement.appendChild(childElement);
}
// end append function

// ========================================

// start request validation
function requestValidation(response, needFunction) {
  if (response.status === 201) {
    needFunction();
  } else if (response.status === 200) {
    needFunction();
  } else if (response.status === 422) {
    errorFunction();
  } else if (response.status === 403) {
    errorFunction();
  } else {
    errorFunction();
  }
}
// end work in validation

// ========================================

// start input filed validation
function inputValidation(inputClassName, submitButtonId) {
  let openButton = document.getElementById(submitButtonId);
  let allInputFiled = document.querySelectorAll(inputClassName);
  let flag = 0;
  let requestData = {};

  openButton.addEventListener("click", () => {
    allInputFiled.forEach((e) => {
      let objectKey = e.name;
      let objectValue = e.value;

      if (objectValue != "") {
        requestData[objectKey] = objectValue;
        flag++;
      } else {
        flag = 0;
      }

      if (flag === allInputFiled.length) {
        console.log(requestData);
      }
    });
  });
}
// end input filed validation

// ========================================