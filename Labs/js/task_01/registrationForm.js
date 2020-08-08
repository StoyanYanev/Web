function validate() {
    let username = getElementByIdFromDocument("username").value;
    let password = getElementByIdFromDocument("password").value;
    let confirmPassword = getElementByIdFromDocument("confirmPassword").value;

    let isValidUsern = isValidUsername(username);
    let isValidPass = isValidPassword(password);
    let isValidConfirmPass = isValidConfirmPassword(confirmPassword, password);

    return isValidUsern && isValidPass && isValidConfirmPass;
}
function hideErrorMessag(elementName) {
    let invalidMessage = getElementByIdFromDocument(elementName);

    if (invalidMessage.innerHTML !== "") {
        invalidMessage.innerHTML = "";
    }
}
function isValidUsername(username) {
    let usernameRegex = /^[a-zA-z0-9_]{3,10}$/;
    if (!username.match(usernameRegex)) {
        showErrorMessage("The username is invalid!", "invalidUsername");
        return false;
    }
    hideErrorMessag("invalidUsername");
    return true;
}
function isValidPassword(password) {
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[A-Za-z0-9]{6,}$/;
    if (!password.match(passwordRegex)) {
        showErrorMessage("The password is invalid!", "invalidPassword");
        return false;
    }
    hideErrorMessag("invalidPassword");
    return true;
}
function isValidConfirmPassword(confirmPassword, password) {
    if (confirmPassword !== password) {
        showErrorMessage("The passwords should be the same!", "invalidConfirmPassword");
        return false;
    }
    hideErrorMessag("invalidConfirmPassword");
    return true;
}
function showErrorMessage(message, elementName) {
    let invalidInput = getElementByIdFromDocument(elementName);
    invalidInput.innerHTML = message;
    invalidInput.style.color = "red";
    invalidInput.style.fontWeight = "bold";
}
function getElementByIdFromDocument(elementName) {
    return document.getElementById(elementName);
}