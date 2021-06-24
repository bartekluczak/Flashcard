const menu = document.getElementById("menu");

window.onscroll = () => window.pageYOffset >= 68 ? menu.classList.add("sticky") : menu.classList.remove("sticky");
