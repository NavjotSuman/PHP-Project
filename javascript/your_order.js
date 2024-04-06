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










// ======================================================================== fetching the orders of the users from the databse.... ==============================================================
let tbody = document.getElementsByTagName("tbody")[0];
let show_myOrder = () => {

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
                                            <div class="delete-img-dustbin__bg">
                                                <img src="images/dustbin.png" data-orderNumber="${orderNumber_id}" class="dustbin-img">
                                            </div>
                                        </div>
                                        </td>
                                    </tr>`;
            }

            // will call the delete function
            delete_myOrder();
        })
}







show_myOrder();