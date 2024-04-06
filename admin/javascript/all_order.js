let orderRow = document.getElementById("display_orders_detail");


let onDeleteClick = () => {
    let delete_button = document.getElementsByClassName("all-user-delete");

    Array.from(delete_button).forEach((value) => {
        value.addEventListener('click', () => {



            // let scrollX = window.scrollX;
            let scrollY = (window.scrollY) + 190;

            let DeleteModal = document.querySelector(".deleteModalStartHere");
            DeleteModal.style.top = `${scrollY}px`;
            // DeleteModal.style.left = "37%";
            DeleteModal.style.display = "block";
            DeleteModal.style.animationName = "start-deleteConfirmModal";
            DeleteModal.style.animationDuration = "400ms";

            // fetching the Confirm Button of The Delete Order modal
            let confirmDelete = document.querySelector(".confirm-btn");

            // fetching the Cancel Button of The Delete Order modal
            let CancelDelete = document.querySelector(".cancel-btn");

            // on Click Confirm of the Deete order modal
            confirmDelete.addEventListener('click', () => {


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
                        // hiding the Delete Confirm Modal
                        DeleteModal.style.animationName = "hide-deleteConfirmModal";
                        DeleteModal.style.animationDuration = "300ms";

                        setTimeout(() => {
                            DeleteModal.style.display = "none";
                            show_orders();
                        }, 280);
                    }
                }).catch((error) => {
                    console.log("error is ");
                })
            })


            CancelDelete.addEventListener('click', () => {
                // hiding the Delete Confirm Modal
                DeleteModal.style.animationName = "hide-deleteConfirmModal";
                DeleteModal.style.animationDuration = "300ms";

                setTimeout(() => {
                    DeleteModal.style.display = "none";
                }, 280);
            })

        })
    })


}


let onEditClick = () => {
    //     console.log("hi");
    let edit_button = document.getElementsByClassName("all-user-edit");

    Array.from(edit_button).forEach((value) => {
        value.addEventListener('click', () => {

            let scrollY = (window.scrollY);

            // making the modal visible to the admin
            let open_modal = document.querySelector(".update_order-modal");
            // update_order-modal
            document.querySelector(".update_order-modal").style.top = `${scrollY}px`;

            open_modal.style.display = "block";


            // exiting the modal 
            let close_modal = document.querySelector(".order-modal-close");
            close_modal.addEventListener('click', () => {
                open_modal.style.display = "none";
                show_orders();
            })

            // window.scroll(0, 0)

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
                document.getElementById("price").firstElementChild.innerHTML = `${price}`;
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









        })
    })
}


// ============================ show all user accounts to admin panel ====================================== 
let show_orders = () => {
    fetch("operations-file/all_orders-fetch.php")
        .then((Response) => {
            return Response.json();
        }).then((array) => {
            orderRow.innerHTML = "";
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
                                            <td>&#8377;${price}</td>
                                            <td>${address}</td>
                                            <td class="border_left border_bottom">
                                            <a class="order_status-btn status-box-${status}" data-icons=""><img style="" class="img-${status}" src="../images/status-${status}.png" > ${status}</a>
                                            </td>
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