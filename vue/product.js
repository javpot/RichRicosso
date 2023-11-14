menu = document.getElementById("menu");
sidebar = document.getElementById("sidebar");
x = document.getElementById("x");
about = document.getElementById("about");
shop = document.getElementById("shop");
log = document.getElementById("log");
const imgElement = document.getElementById("image-product");
dot1 = document.getElementById("dot1");
dot2 = document.getElementById("dot2");
dot1Selected = true;

const imgSrc = imgElement.getAttribute("src");

const imgProduct = imgSrc;

console.log(imgProduct);

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

const dot1Clicked = () => {
    if (dot1Selected == false) {
        dot1.style.backgroundColor = "#404040";
        dot2.style.backgroundColor = "#6f6f6f";
        currentSrc = imgElement.getAttribute("src");
        lastDotIndex = currentSrc.lastIndexOf(".");
        beforeLastDot = currentSrc.substring(0, lastDotIndex);
        afterLastDot = currentSrc.substring(lastDotIndex);
        if (beforeLastDot.charAt(beforeLastDot.length - 1) === "1") {
            beforeLastDot = beforeLastDot.substring(0, beforeLastDot.length - 1);
        }
        newSrc = beforeLastDot + afterLastDot;
        imgElement.setAttribute("src", newSrc);
        dot1Selected = true;
    }

}
const dot2Clicked = () => {
    if (dot1Selected) {
        dot2.style.backgroundColor = "#404040";
        dot1.style.backgroundColor = "#6f6f6f";
        const currentSrc = imgElement.getAttribute("src");
        const lastDotIndex = currentSrc.lastIndexOf(".");
        const beforeLastDot = currentSrc.substring(0, lastDotIndex);
        const afterLastDot = currentSrc.substring(lastDotIndex);
        const newSrc = beforeLastDot + "1" + afterLastDot;
        imgElement.setAttribute("src", newSrc);
        dot1Selected = false;
    }
}

menu.addEventListener("click", showSidebar);
dot1.addEventListener("click", dot1Clicked);
dot2.addEventListener("click", dot2Clicked);
x.addEventListener("click", hideSidebar);
about.addEventListener("click", hideSidebar);
shop.addEventListener("click", hideSidebar);
log.addEventListener("click", hideSidebar);

