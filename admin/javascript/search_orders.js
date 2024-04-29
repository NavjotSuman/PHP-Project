// ======================================= SCRIPT OF THE DETAILS BUTTON AFTER SEARCH RESULT =========================

let details_btn = document.getElementsByClassName("search-details-btn")[0];




// order_searcg_btn.

details_btn.addEventListener('click', () => {


    let check_details_btn = details_btn.getAttribute("data-show");

    if (check_details_btn != "true") {
        details_btn.setAttribute("data-show", "true");
        document.getElementsByClassName("searchDetailsModal")[0].style.display = "block";

        document.getElementsByClassName("cancle-btn")[0].addEventListener('click', () => {
            details_btn.removeAttribute("data-show");
            document.getElementsByClassName("searchDetailsModal")[0].style.display = "none";
        })
    }
    else {
        details_btn.removeAttribute("data-show");
        document.getElementsByClassName("searchDetailsModal")[0].style.display = "none";
    }


})




// =========================================================================== ON CLICK ON THE CANCEL STATUS BUTTON OF THE ORDER

let cancelStatusBox = document.getElementsByClassName("status-box-Cancelled")
Array.from(cancelStatusBox).forEach((value) => {
    value.addEventListener('click', () => {

        if (value.classList.contains("display-reason")) {
            value.parentElement.firstElementChild.style.display = "none"
            value.classList.remove("display-reason");
        }
        else {
            value.parentElement.firstElementChild.style.display = "block"
            value.classList.add("display-reason");
        }
    })
})














// =================================================== SCRIPT FROM FROM ALL ORDERS FRO THE BUTTONS OF THE SESILT OF THE SEARCH =================================================================================

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


                const delete_Id = value.getAttribute("data-order_id");
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
                            location.reload();
                            start_order_buttons();
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
                start_order_buttons();
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


let start_order_buttons = () => {
    onDeleteClick();
    onEditClick();
}

start_order_buttons();