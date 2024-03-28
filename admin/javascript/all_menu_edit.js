// =================================== Set the Previous restaurant in select restaurant option ============================================

// data-previous_value

let previous_value = document.getElementsByClassName("pre-value");

previous_value = Array.from(previous_value);

previous_value.forEach((x) => {
    // console.log(x)
    let val = x.getAttribute("data-previous_value");
    x.value = val;
})