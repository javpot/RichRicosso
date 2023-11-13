menu = document.getElementById("menu");
sidebar = document.getElementById("sidebar");
x = document.getElementById("x");
const value = document.querySelector("#value");
const input = document.querySelector("#range-prix");
value.textContent = input.value;
filtre = document.getElementById("filtre");
filtreContainer = document.getElementById("filtre-container");
xFiltre = document.getElementById("x-text");
buttonFiltre = document.getElementById("button-filtre");
chemiseCheck = document.getElementById("chemise-check");
taille = document.querySelectorAll(".taille");

input.addEventListener("input", (event) => {
    value.textContent = ">" + event.target.value + "$";
});

const showSidebar = () => {
    sidebar.style.visibility = "visible";
    const contentContainer = document.querySelector(".content-container");
    contentContainer.classList.add("blur-background");
};

const hideSidebar = () => {
    sidebar.style.visibility = "hidden";
    const contentContainer = document.querySelector(".content-container");
    contentContainer.classList.remove("blur-background");
};

const showFiltre = () => {
    filtreContainer.style.visibility = "visible";
};
const hideFiltre = () => {
    filtreContainer.style.visibility = "hidden";
};
const isChemiseChecked = () => {
    if (chemiseCheck.checked) {
        console.log("check");
        taille.forEach((checkbox) => {
            checkbox.checked = false;
            checkbox.disabled = true;
        });
    } else {
        taille.forEach((checkbox) => {
            checkbox.disabled = false;
        });
    }
};

menu.addEventListener("click", showSidebar);
x.addEventListener("click", hideSidebar);
filtre.addEventListener("click", showFiltre);
xFiltre.addEventListener("click", hideFiltre);
buttonFiltre.addEventListener("click", hideFiltre);
chemiseCheck.addEventListener("click", isChemiseChecked);
