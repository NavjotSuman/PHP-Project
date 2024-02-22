// navmenu display on hamburger-icon click

let hamburger = document.getElementById("open-menu-btn");
let close_menu = document.getElementById("close-menu-btn");
let nav_menu = document.querySelector(".nav__menu");
// console.log(hamburger)
hamburger.addEventListener('click', () => {
    nav_menu.style.display = "flex";

    close_menu.style.display = "block";
    hamburger.style.display = "none";

})
close_menu.addEventListener('click', () => {
    nav_menu.style.display = "none";

    hamburger.style.display = "block";
    close_menu.style.display = "none";

})



let a = document.getElementsByClassName("data-input");
// console.log(a);
Array.from(a).forEach((value) => {

    value.addEventListener('focus', () => {
        value.style.border = "1px solid #5c4ac7";
    })
    value.addEventListener('focusout', () => {
        value.style.border = "1px solid #eaebeb";

    })
    // console.log(value);
})




// ============================================================= POPULAR DISHES IMAGE ==================================================================
// background: url('../admin/Res_img/dishes/');

let dish_img = document.getElementsByClassName("dish-img");
var xyz = Array.from(dish_img);
Array.from(dish_img).forEach((value) => {
    // console.log(value);
    let n = value.getAttribute('data-img_src');
    value.style.background = `url('admin/Res_img/dishes/${n}')`;

    // background-repeat: no-repeat;
    // background-position: center center;
    // background-size: cover;

    value.style.backgroundRepeat = "no-repeat";
    value.style.backgroundPosition = "center center";
    value.style.backgroundSize = "cover";
})






//============================================================== RESTAURANTS CATEGORIES ==============================================================================================

let res_categories = document.getElementsByClassName("res-nav-list-items")
let all_res_categories = document.getElementsByClassName("res-nav__menu-li")
let select_article = document.getElementsByClassName("select-article")
let all_selected = document.querySelector(".allSelected")
let selected = document.querySelector(".Selected")
let data_idNum = 0;
let underline_nav = "All"




// all categories Except ALL
Array.from(res_categories).forEach((value) => {
    value.addEventListener('click', () => {

        // Array.from(all_res_categories).forEach((value) => {
        //     value.style.textDecoration = "underline";
        // })

        data_idNum = value.getAttribute("data-idNum");

        // caling again for set class = slect me evert time whenever we selecting a nav-item 
        Array.from(res_categories).forEach((value) => {
            value.classList.add('select-me')
            value.style.textDecoration = "none"
        })
        // checking is it alredy seleted one or not
        let isSelected = value.classList.contains("select-me")
        if (isSelected) {
            value.classList.add('Selected')
            value.classList.remove('select-me')

            // styling under to all resting the underline from the other ones
            all_selected.style.textDecoration = "none";
            value.style.textDecoration = "underline";


            // changing the class of "All"  
            if (all_selected.classList.contains('Selected')) {
                all_selected.classList.add('select-me')
                all_selected.classList.remove('Selected')
                // all_selected.style.textDecoration = "none";
            }

            // changing the display of the restaurants on click 
            Array.from(select_article).forEach((value) => {
                let check_idNum = value.classList.contains(data_idNum);
                if (check_idNum) {
                    value.style.display = "flex";
                } else {
                    value.style.display = "none";
                }
            })
        }

    })
})


// on-clik on "All", it will set every thing as default 
all_selected.addEventListener('click', () => {
    Array.from(select_article).forEach((value) => {
        value.style.display = "flex";
    })

    all_selected.classList.add('Selected')
    all_selected.classList.remove('select-me')
    displayAllArticles = true

    Array.from(res_categories).forEach((value) => {
        value.classList.add("select-me");
        value.classList.remove("Selected");
        // styling under to all resting the underline from the other ones
        value.style.textDecoration = "none"
    })

    // styling under to all resting the underline from the other ones
    all_selected.style.textDecoration = "underline"

})



