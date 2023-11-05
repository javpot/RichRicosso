

menu = document.getElementById("menu");
sidebar = document.getElementById("sidebar");
x = document.getElementById("x");
const value = document.querySelector("#value");
const input = document.querySelector("#range-prix");
value.textContent = input.value;




input.addEventListener("input", (event) => {
    value.textContent = ">" + event.target.value + "$";
});

const showSidebar = () => {
    sidebar.style.visibility = "visible";
    const contentContainer = document.querySelector(".content-container");
    contentContainer.classList.add("blur-background");
}

const hideSidebar = () => {
    sidebar.style.visibility = "hidden";
    const contentContainer = document.querySelector(".content-container");
    contentContainer.classList.remove("blur-background");
}

menu.addEventListener("click", showSidebar);
x.addEventListener("click", hideSidebar);
