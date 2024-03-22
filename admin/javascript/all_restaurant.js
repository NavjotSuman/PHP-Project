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
                            <a class="all_user-action all_user-action-edit all_user-edit" data-restaurant_number="${rs_id}"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                        </td>
                    </tr>`

            }


            onDeleteClick();
        })
}




showAll_restaurant();