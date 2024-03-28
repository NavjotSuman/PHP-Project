let Restaurent_tbody = document.querySelector("#display_users_detail");


let onDeleteClick = () => {
    let delete_button = document.getElementsByClassName("all_user-delete");

    Array.from(delete_button).forEach((value) => {
        value.addEventListener('click', () => {

            let delete_Id = value.getAttribute("data-restaurant_number")
            //         // console.log(delete_Id);
            let fetchValues = {
                "delId": `${delete_Id}`,
            }

            fetch("operations-file/all_restaurant_delete-btn.php", {
                method: "POST",
                body: JSON.stringify(fetchValues),
                headers: {
                    "Content-type": "application/json",
                }
            }).then((Response) => {
                return (Response.json());
            }).then((result) => {
                if (result.deleted == 'success') {
                    console.log(`Order Deleted Successfully`);
                    showAll_restaurant();
                }
            }).catch((error) => {
                console.log("error is ");
            })
        })
    })


}


// on edit button click
// let onEditClick = () => {
//     let edit_button = document.getElementsByClassName("all_user-edit");

//     Array.from(edit_button).forEach((value) => {
//         value.addEventListener('click', () => {
//             let res_id = value.getAttribute("data-restaurant_number");

//             let fetchValues = {
//                 "resid": `${res_id}`,
//             }
//             fetch("operations-file/all_restaurant_modal-fetch.php", {
//                 method: "post",
//                 body: JSON.stringify(fetchValues),
//                 headers: {
//                     "Content-type": "application/json",
//                 }
//             }).then((Response) => {
//                 return Response.json();
//             }).then((value) => {
//                 // console.log(value);

//                 // opening the modal
//                 document.querySelector(".update_restaurant-modal").style.display = "block";

//                 // closing the modal
//                 document.querySelector(".cancle-btn").addEventListener('click', () => {
//                     document.querySelector(".update_restaurant-modal").style.display = "none";
//                 })

//                 let title = value[0].title
//                 let email = value[0].email
//                 let phone = value[0].phone
//                 let url = value[0].url
//                 let ohr = value[0].ohr
//                 let chr = value[0].chr
//                 let odays = value[0].odays
//                 let address = value[0].address
//                 let image = value[0].image
//                 let category = value[0].category;

//                 console.log(title)
//                 console.log(email)
//                 console.log(phone)
//                 console.log(url)
//                 console.log(ohr)
//                 console.log(chr)
//                 console.log(odays)
//                 console.log(address)
//                 console.log(image)

//                 document.getElementById("res_name").value = `${title}`;
//                 document.getElementById("bussiness_email").value = `${email}`;
//                 document.getElementById("Phone").value = `${phone}`;
//                 document.getElementById("web_url").value = `${url}`;
//                 document.getElementById("o_hrs").value = `${ohr}`;
//                 document.getElementById("c_hrs").value = `${chr}`;
//                 document.getElementById("o_day").value = `${odays}`;
//                 document.getElementById("category").value = `${category}`;
//                 document.getElementById("res_address").value = `${address}`;
//                 document.getElementById("image").parentElement.firstElementChild.firstElementChild.innerHTML = `${image}`;
//                 let img_location = document.getElementById("image");
//                 img_location.setAttribute("data-image_name", `${image}`)


//                 // set there a update function for update the database
//                 let update_btn = document.querySelector(".update-btn");
//                 update_btn.addEventListener('click', (e) => {
//                     e.preventDefault();
//                 })
//             }).catch((error) => {
//                 console.log('error is ', error);
//             })
//         })
//     })
// }


// ================================================================  DISPLAYING ALL THE RESTAURANTS ======================================================
let showAll_restaurant = () => {
    Restaurent_tbody.innerHTML = "";

    fetch("operations-file/all_restaurant-fetch.php")
        .then((Response) => {
            return Response.json();
        }).then((data) => {
            for (let i = 0; i < data.length; i++) {
                let category = data[i].category;
                let name = data[i].name;
                let email = data[i].email;
                let phone = data[i].phone;
                let url = data[i].url;
                let openHrs = data[i].openHrs;
                let closeHrs = data[i].closeHrs;
                let openDays = data[i].openDays;
                let address = data[i].address;
                let image = data[i].image;
                let date = data[i].date;
                let rs_id = data[i].rs_id;

                Restaurent_tbody.innerHTML += `<tr>
                        <td>${category}</td>
                        <td>${name}</td>
                        <td>${email}</td>
                        <td>${phone}</td>
                        <td>${url}</td>
                        <td>${openHrs}</td>
                        <td>${closeHrs}</td>
                        <td>${openDays}</td>
                        <td>${address}</td>
                        <td><img class="all_res_img" src="Res_img/${image}" alt="" srcset=""></td>
                        <td>${date}</td>
                        <td class="action_data">
                            <a class="all_user-action all_user-action-trash all_user-delete" data-restaurant_number="${rs_id}"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                            <a href="all_restaurant_edit-update.php?res_id=${rs_id}" class="all_user-action all_user-action-edit all_user-edit" data-restaurant_number="${rs_id}"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                        </td>
                    </tr>`

            }


            onDeleteClick();
            // onEditClick();
        })
}




showAll_restaurant();