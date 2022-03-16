// start build element
function elementBuilder(elementName, elementAttribute, attributeNumber, elementContent, contentType, elementNumber, parentElement) {
    for (let index = 0; index < elementNumber; index++) {
        let childElement = document.createElement(elementName)

        for (let index = 0; index < attributeNumber; index++) {
            childElement.setAttribute(elementAttribute[index].name, elementAttribute[index].value)
        }

        childElement.contentType = elementContent
        
        if (!!parentElement) {
            appendElement(parentElement, childElement)
        }
    }
}
// end build element

// ========================================

// start append function
function appendElement(parentElement, childElement) {
    parentElement.appendChild(childElement)
}
// end append function

// ========================================

// start request validation 
function requestValidation(response, needFunction) {
    if (response.status === 201) {
        needFunction()
    } else if (response.status === 200) {
        needFunction()
    } else if (response.status === 422) {
        errorFunction()
    } else if (response.status === 403) {
        errorFunction()
    } else {
        errorFunction()
    }
}
// end work in validation