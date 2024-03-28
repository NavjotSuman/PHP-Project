// fetching the value from the url 
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const res_id = urlParams.get('res_id');


let fetchValues = {
    "resid": `${res_id}`,
}
fetch("operations-file/all_restaurant_modal-fetch.php", {
    method: "post",
    body: JSON.stringify(fetchValues),
    headers: {
        "Content-type": "application/json",
    }
}).then((Response) => {
    return Response.json();
}).then((value) => {
    // console.log(value);

    // opening the modal
    document.querySelector(".update_restaurant-modal").style.display = "block";

    // closing the modal
    document.querySelector(".cancle-btn").addEventListener('click', () => {
        document.querySelector(".update_restaurant-modal").style.display = "none";
    })

    let title = value[0].title
    let email = value[0].email
    let phone = value[0].phone
    let url = value[0].url
    let ohr = value[0].ohr
    let chr = value[0].chr
    let odays = value[0].odays
    let address = value[0].address
    let image = value[0].image
    let category = value[0].category;

    // console.log(title)
    // console.log(email)
    // console.log(phone)
    // console.log(url)
    // console.log(ohr)
    // console.log(chr)
    // console.log(odays)
    // console.log(address)
    // console.log(image)

    document.getElementById("res_name").value = `${title}`;
    document.getElementById("bussiness_email").value = `${email}`;
    document.getElementById("Phone").value = `${phone}`;
    document.getElementById("web_url").value = `${url}`;
    document.getElementById("o_hrs").value = `${ohr}`;
    document.getElementById("c_hrs").value = `${chr}`;
    document.getElementById("o_day").value = `${odays}`;
    document.getElementById("category").value = `${category}`;
    document.getElementById("res_address").value = `${address}`;
    document.getElementById("image").parentElement.firstElementChild.firstElementChild.innerHTML = `${image}`;
    let img_location = document.getElementById("image");
    img_location.setAttribute("data-image_name", `${image}`)


}).catch((error) => {
    console.log('error is ', error);
})