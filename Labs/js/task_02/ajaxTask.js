function send() {
    let username = getElementByIdFromDocument("username").value;
    let password = getElementByIdFromDocument("password").value;
    let confirmPassword = getElementByIdFromDocument("confirmPassword").value;

    let object = { username, password, confirmPassword };
    let jsonToBeSent = converObjectToJSON(object);

    const url = "./register.php"
    let callback = function (text) {
        console.log(text);
    };

    ajax(url, { success: callback, data: jsonToBeSent });
}
function getElementByIdFromDocument(elementName) {
    return document.getElementById(elementName);
}
function converObjectToJSON(object) {
    return JSON.stringify(object);
}
function ajax(url, settings) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function () {
        if (xhr.status == 200) {
            settings.success(xhr.response);
        } else {
            console.error(xhr.response);
        }
    };
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-Type", "application/json;");
    xhr.send(settings.data);
}