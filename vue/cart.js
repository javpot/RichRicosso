menu = document.getElementById("menu");
sidebar = document.getElementById("sidebar");
x = document.getElementById("x");
about = document.getElementById("about");
shop = document.getElementById("shop");
log = document.getElementById("log");

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


menu.addEventListener("click",showSidebar);
x.addEventListener("click",hideSidebar);
about.addEventListener("click",hideSidebar);
shop.addEventListener("click",hideSidebar);
log.addEventListener("click",hideSidebar);