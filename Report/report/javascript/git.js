window.onload = function() {
    let menuItems = document.getElementById('menu').children;
    for (let index = 0; index < menuItems.length; index++) {
        menuItems[index].addEventListener('click', this.changeActiveElement);
    }
}

function changeActiveElement() {
    const className = "active";

    let currentActiveElement = document.getElementsByClassName(className);
    currentActiveElement[0].className = currentActiveElement[0].className.replace(className, "");
    this.className += className;
}