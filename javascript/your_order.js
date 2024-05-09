// console.log(tbody)



// ================================================================== Delete the Orders from the your user in one click without any refresh ==============================================================================

/* *i will call it after show_myOrder Function it will get automatically callled */
let delete_myOrder = () => {
    let deleteButton = document.getElementsByClassName("delete-img-dustbin__bg");
    // console.log(deleteButton);

    Array.from(deleteButton).forEach((value) => {
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

                // console.log(value.lastElementChild.getAttribute("data-ordernumber"));
                let delete_orderNumber = value.lastElementChild.getAttribute("data-ordernumber");

                // console.log(delete_orderNumber);

                let passValues = {
                    "Delete_order": `${delete_orderNumber}`,
                }
                fetch("phpDatabase/cancel-order.php", {
                    method: "POST",
                    body: JSON.stringify(passValues),
                    headers: {
                        "Content-type": "application/json",
                    }
                }).then((Response) => {
                    return Response.json();
                }).then((value) => {
                    if (value.deleteOrder) {
                        console.log("Your Order is Cancelled");
                        // hiding the Delete Confirm Modal
                        DeleteModal.style.animationName = "hide-deleteConfirmModal";
                        DeleteModal.style.animationDuration = "300ms";

                        setTimeout(() => {
                            DeleteModal.style.display = "none";
                        }, 280);

                        // calling the show order function for refresh orders without refresh the page
                        show_myOrder();
                    }
                })

            })

            // console.log(CancelDelete)

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







// ================================================== CANCEL YOUR ORDER ======================
let cancel_myorder = () => {
    let cancelButton = document.getElementsByClassName("cancel-img-dustbin__bg");
    // console.log(cancelButton);

    Array.from(cancelButton).forEach((value) => {
        value.addEventListener('click', () => {

            // let scrollX = window.scrollX;
            let scrollY = (window.scrollY) + 190;

            let cancelModal = document.querySelector(".cancelModalStartHere");
            cancelModal.style.top = `${scrollY}px`;
            // DeleteModal.style.left = "37%";
            cancelModal.style.display = "block";
            cancelModal.style.animationName = "start-deleteConfirmModal";
            cancelModal.style.animationDuration = "400ms";


            // fetching the Confirm Button of The Delete Order modal
            let confirmCancel = document.querySelector(".cancel-confirm-btn");

            // fetching the Cancel Button of The Delete Order modal
            let cancelCancel = document.querySelector(".cancel-cancel-btn");


            // on Click Confirm of the Deete order modal
            confirmCancel.addEventListener('click', () => {

                // console.log(value.lastElementChild.getAttribute("data-ordernumber"));
                let cancel_orderNumber = value.lastElementChild.getAttribute("data-ordernumber");

                let cancel_reason = document.getElementById("cancel_reason").value;
                // console.log(cancel_orderNumber);

                // checking if the the textarea is empty or not
                let can_reason = "";
                if (cancel_reason == "" || cancel_reason.trim() == "") {
                    can_reason = "No Reason";
                }
                else {
                    can_reason = cancel_reason;
                }


                // fulling the values
                let passValues = {
                    "odr_id": `${cancel_orderNumber}`,
                    "can_reason": `${can_reason}`,
                }
                fetch("phpDatabase/cancel-order-reason.php", {
                    method: "POST",
                    body: JSON.stringify(passValues),
                    headers: {
                        "Content-type": "application/json",
                    }
                }).then((Response) => {
                    return Response.json();
                }).then((value) => {
                    if (value.cancelOrder) {
                        console.log("Your Order is Cancelled");
                        // hiding the Delete Confirm Modal
                        cancelModal.style.animationName = "hide-deleteConfirmModal";
                        cancelModal.style.animationDuration = "300ms";

                        setTimeout(() => {
                            cancelModal.style.display = "none";
                        }, 280);

                        // calling the show order function for refresh orders without refresh the page
                        show_myOrder();
                    }
                })

            })




            // on click on the cancel of the cancel order modal
            // console.log(CancelDelete)

            cancelCancel.addEventListener('click', () => {
                // hiding the Delete Confirm Modal
                cancelModal.style.animationName = "hide-deleteConfirmModal";
                cancelModal.style.animationDuration = "300ms";

                setTimeout(() => {
                    cancelModal.style.display = "none";
                }, 280);
            })

        })
    })

}








// ======================================================================== fetching the orders of the users from the databse.... ==============================================================
let show_myOrder = () => {
    let tbody = document.getElementsByTagName("tbody")[0];

    tbody.innerHTML = "";
    fetch("phpDatabase/show-orders.php")
        .then((Response) => {
            return Response.json();
        }).then((data) => {
            for (let i = 0; i < data.length; i++) {
                let itemName = data[i].title;
                let itemQuantity = data[i].quantity;
                let price = data[i].price;
                let status = data[i].status;
                let date = data[i].date;
                let orderNumber_id = data[i].o_id;

                let show_actionDelete = "none";
                let show_actionCancel = "none";
                if (status == "Cancelled" || status == "Delivered") {
                    show_actionDelete = "flex";
                }
                else {
                    show_actionCancel = "flex";
                }

                tbody.innerHTML += `<tr>
                                        <td class="border_left border_bottom">${itemName}</td>
                                        <td class="border_left border_bottom">${itemQuantity}</td>
                                        <td class="border_left border_bottom">&#8377; ${price}</td>
                                        <td class="border_left border_bottom">
                                        <a class="order_status-btn status-box-${status}" data-icons=""><img style="" class="img-${status}" src="images/status-${status}.png" > ${status}</a>
                                        </td>
                                        <td class="border_left border_bottom">${date}</td>
                                        <td class="border_left border_right border_bottom delete-Button" style="padding:0;padding-right: 7px;text-align: center;">
                                        <div class="delete-img-dustbin">
                                            <div style="display:${show_actionDelete}" class="delete-img-dustbin__bg">
                                                <img src="images/dustbin.png" data-orderNumber="${orderNumber_id}" class="dustbin-img">
                                            </div>
                                            <div style="display:${show_actionCancel}" class="cancel-img-dustbin__bg">
                                                <img src="images/cancel.png" data-orderNumber="${orderNumber_id}" class="dustbin-img">
                                            </div>
                                        </div>
                                        </td>
                                    </tr>`;
            }

            // will call the delete function
            delete_myOrder();
            cancel_myorder();
        })
}







show_myOrder();