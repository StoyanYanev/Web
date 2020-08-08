const INVALID_USERNAME_ID = "invalid-username";
const INVALID_NAMES_ID = "invalid-names";
const INVALID_EMAIL_ID = "invalid-email";
const INVALID_PASSWORD_ID = "invalid-password";
const INVALID_ZIP_CODE_ID = "invalid-zipCode";
const ERROR_MESSAGE_ID = "error-message";
const SUCCESSFUL_MESSAGE_ID = "successful-message";

const USERNAME_REGEX = /^\w{3,10}$/;
const NAMES_REGEX = /^[A-Z][a-z]+ [A-Z][a-z]+$/;
const EMAIL_REGEX = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w+)+$/;
const PASSWORD_REGEX = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,10}$/;
const ZIP_CODE_REGEX = /^\d{5}-\d{4}$/;

const ALREADY_EXISTING_USERNAME_MESSAGE = "The username already exists!";
const SUCCESSFUL_REGISTRATION_MESSAGE = "Successful registration!";
const ERROR_USERNAME_MESSAGE = "The username must be between 3 and 10 symbols!";
const ERROR_NAMES_MESSAGE = "Enter correct first and last name!";
const ERROR_EMAIL_MESSAGE = "The email is in invalid format!";
const ERROR_PASSWORD_MESSAGE = "The password must be between 6 and 10 symbols and should contain at least one letter and digit!";
const ERROR_ZIP_CODE_MESSAGE = "The zip code is in invalid format! The allowed format is 11111-1111.";

const EMPTY = "";
const REQUEST_URL = "https://jsonplaceholder.typicode.com/users";
const REQUEST_METHOD = "GET";

window.onload = function() {
    getElementByIdFromDocument("registration").addEventListener('submit', function(event) { event.preventDefault(); });
}

function validateFields() {
    let isFieldsValid = isUsernameValid() &&
        isNamesValid() &&
        isEmailValid() &&
        isPasswordValid() &&
        isZipCodeValid();

    if (isFieldsValid) {
        let username = getElementByIdFromDocument('username').value;
        registerUser(username);
        return true;
    }
    hideMessage(ERROR_MESSAGE_ID);
    hideMessage(SUCCESSFUL_MESSAGE_ID);
    showErrorMessage('Invalid fields!', ERROR_MESSAGE_ID);
    return false;
}

function registerUser(username) {
    setTimeout(() => 4000);
    fetch(REQUEST_URL, {
            method: REQUEST_METHOD
        }).then(response => response.json())
        .then(users => {
            if (!isUsernameExisting(username, users)) {
                hideMessage(ERROR_MESSAGE_ID);
                showSuccessfulMessage(SUCCESSFUL_REGISTRATION_MESSAGE, SUCCESSFUL_MESSAGE_ID);
                getElementByIdFromDocument("registration").reset();
            } else {
                hideMessage(SUCCESSFUL_MESSAGE_ID);
                showErrorMessage(ALREADY_EXISTING_USERNAME_MESSAGE, ERROR_MESSAGE_ID);
            }
        });
}

function isUsernameExisting(username, users) {
    for (const user of users) {
        if (user.username === username) {
            return true;
        }
    }

    return false;
}

function getElementByIdFromDocument(elementName) {
    return document.getElementById(elementName);
}

function isUsernameValid() {
    let username = getElementByIdFromDocument("username").value;
    if (username.length < 3 || username.length > 10) {
        showErrorMessage(ERROR_USERNAME_MESSAGE, INVALID_USERNAME_ID);
        return false
    }

    return validateField(username, USERNAME_REGEX, INVALID_USERNAME_ID, ERROR_USERNAME_MESSAGE, true);
}

function isNamesValid() {
    let names = getElementByIdFromDocument("names").value;
    return validateField(names, NAMES_REGEX, INVALID_NAMES_ID, ERROR_NAMES_MESSAGE, true);
}

function isEmailValid() {
    let email = getElementByIdFromDocument("email").value;
    return validateField(email, EMAIL_REGEX, INVALID_EMAIL_ID, ERROR_EMAIL_MESSAGE, true);
}

function isPasswordValid() {
    let password = getElementByIdFromDocument("password").value;
    return validateField(password, PASSWORD_REGEX, INVALID_PASSWORD_ID, ERROR_PASSWORD_MESSAGE, true);
}

function isZipCodeValid() {
    let zipCode = getElementByIdFromDocument("zip-code").value;
    let isZipCodeFielld = true;
    if (zipCode.length === 0) {
        isZipCodeFielld = false;
    }
    return validateField(zipCode, ZIP_CODE_REGEX, INVALID_ZIP_CODE_ID, ERROR_ZIP_CODE_MESSAGE, isZipCodeFielld);
}

function validateField(field, regex, invalidFieldId, message, isRequired) {
    if (field.length == 0 && isRequired) {
        showErrorMessage("The field is required!", invalidFieldId);
        return false;
    }
    if (!field.match(regex) && isRequired) {
        showErrorMessage(message, invalidFieldId);
        return false;
    }
    hideMessage(invalidFieldId);
    return true;
}

function showErrorMessage(message, elementName) {
    let invalidLabel = getElementByIdFromDocument(elementName);
    invalidLabel.innerHTML = message;
}

function hideMessage(elementName) {
    let invalidLabel = getElementByIdFromDocument(elementName);

    if (invalidLabel.innerHTML !== EMPTY) {
        invalidLabel.innerHTML = EMPTY;
    }
}

function showSuccessfulMessage(message, elementName) {
    let successLabel = getElementByIdFromDocument(elementName);
    successLabel.innerHTML = message;
}