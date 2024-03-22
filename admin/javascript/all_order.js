let orderRow = document.getElementById("display_orders_detail");


let onDeleteClick = () => {
    let delete_button = document.getElementsByClassName("all-user-delete");

    Array.from(delete_button).forEach((value) => {
        value.addEventListener('click', () => {
            let delete_Id = value.getAttribute("data-order_id");
            // console.log(delete_Id);
            let fetchValues = {
                "uid": `${delete_Id}`,
            }

            fetch("operations-file/all_orders-delete.php", {
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
                    show_orders();
                }
            }).catch((error) => {
                console.log("error is ");
            })
        })
    })


}


let onEditClick = () => {
    //     console.log("hi");
    let edit_button = document.getElementsByClassName("all-user-edit");

    Array.from(edit_button).forEach((value) => {
        value.addEventListener('click', () => {
            // making the modal visible to the admin
            let open_modal = document.querySelector(".update_order-modal");
            open_modal.style.display = "block";


            // using the fetch for display the user_order details into the modal
            let orderId = value.getAttribute("data-order_id");
            let fetchValue = {
                "oid": `${orderId}`,
            }
            fetch("operations-file/modal-editOrder_fetch.php", {
                method: "POST",
                body: JSON.stringify(fetchValue),
                headers: {
                    "Content-type": "application/json",
                }
            }).then((Response) => {
                return Response.json();
            }).then((data) => {
                let username = data[0].username;
                let title = data[0].title;
                let quantity = data[0].quantity;
                let price = data[0].price;
                let address = data[0].address;
                let date = data[0].date;
                let status = data[0].status;
                // these are fetched for use main two buttons of the modal
                let u_id = data[0].u_id;
                let o_id = data[0].o_id;

                // console.log("user id is ", u_id)
                // console.log("order id is ", o_id)

                /** i was checkking the values */
                // console.log(data);
                // console.log(data[0].date);

                document.getElementById("username").innerHTML = `${username}`;
                document.getElementById("title").innerHTML = `${title}`;
                document.getElementById("quantity").innerHTML = `${quantity}`;
                document.getElementById("price").innerHTML = `${price}`;
                document.getElementById("address").innerHTML = `${address}`;
                document.getElementById("date").innerHTML = `${date}`;
                document.getElementById("status").innerHTML = `${status}`;

                // opening the new browser window for the user Profile page
                document.querySelector(".view-user-details").addEventListener('click', () => {
                    window.open(`userProfile.php?newform_id=${u_id}`, "newWindow", "popup, width=900, height= 600")
                })

                // opening the new browser window for the update order Status
                document.querySelector(".update-order-status").addEventListener('click', () => {
                    window.open(`orderUpdate.php?form_id=${o_id}`, "newWindow", "popup, width=900, height= 600")

                })

            }).catch((error) => {
                console.log("Error is", error);
            })



            // exiting the modal 
            let close_modal = document.querySelector(".order-modal-close");
            close_modal.addEventListener('click', () => {
                open_modal.style.display = "none";
                show_orders();
            })





        })
    })
}


// ============================ show all user accounts to admin panel ====================================== 
let show_orders = () => {
    orderRow.innerHTML = "";
    fetch("operations-file/all_orders-fetch.php")
        .then((Response) => {
            return Response.json();
        }).then((array) => {
            // to print the array return in json form
            // console.log(array);
            for (let i = 0; i < array.length; i++) {
                let username = array[i].username;
                let address = array[i].address;
                let title = array[i].title;
                let quantity = array[i].quantity;
                let price = array[i].price;
                let status = array[i].status;
                let date = array[i].date;
                let oid = array[i].order_id;

                orderRow.innerHTML += `<tr>
                                            <td>${username}</td>
                                            <td>${title}</td>
                                            <td>${quantity}</td>
                                            <td>${price}</td>
                                            <td>${address}</td>
                                            <td>${status}</td>
                                            <td>${date}</td>
                                            <td class="action_data">
                                                <a class="all_user-action all-user-delete all_user-action-trash" data-order_id="${oid}"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                                <a class="all_user-action all_user-action-edit all-user-edit" data-order_id="${oid}"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                            </td>
                                        </tr>`;


            }

            onDeleteClick();
            onEditClick();

        })
}


show_orders();