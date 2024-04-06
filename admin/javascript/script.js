//  ==============================================================  Arrow of the Aside  ===================================================================
let aside_arrow = document.getElementsByClassName("arraw-img");
// let a = document.getElementsByClassName("arraw-img")[0].parentElement.parentElement.lastElementChild;

Array.from(aside_arrow).forEach((value) => {
    value.parentElement.addEventListener('click', () => {
        let hidden_value = value.parentElement.parentElement.lastElementChild;
        let arrow_img = hidden_value.parentElement.firstElementChild.lastElementChild
        if (hidden_value.hasAttribute("hidden")) {
            hidden_value.removeAttribute("hidden");
            arrow_img.style.rotate = "90deg";
        }
        else {
            hidden_value.setAttribute("hidden", "true");
            arrow_img.style.rotate = "0deg";
        }
    })
})




// =============================================================================== logout Button js ===============================================================================================
const logout_icon = document.querySelector(".logout-profile").firstElementChild;
const navMenu = document.querySelector(".nav__menu");
logout_icon.addEventListener('click', () => {
    if ((navMenu.getAttribute("data-start") == "true")) {
        navMenu.style.animationName = "navbarDisable"
        navMenu.style.animationDuration = "500ms"
        navMenu.removeAttribute("data-start")
        setTimeout(() => {
            navMenu.style.display = "none";
        }, 500);
    }
    else {
        navMenu.style.display = "block";
        navMenu.style.animationName = "navbarAnimation"
        navMenu.style.animationDuration = "500ms"
        navMenu.setAttribute("data-start", "true");
    }
})

