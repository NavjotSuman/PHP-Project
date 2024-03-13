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