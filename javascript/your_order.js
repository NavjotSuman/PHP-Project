// console.log(tbody)



// ================================================================== Delete the Orders from the your user in one click without any refresh ==============================================================================

/* *i will call it after show_myOrder Function it will get automatically callled */
let delete_myOrder = () => {
    let deleteButton = document.getElementsByClassName("delete-img-dustbin__bg");
    console.log(deleteButton);

    Array.from(deleteButton).forEach((value) => {
        value.addEventListener('click', () => {
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

                    // calling the show order function for refresh orders without refresh the page
                    show_myOrder();
                }
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
                                        <td class="border_left border_bottom">${price}</td>
                                        <td class="border_left border_bottom">${status}</td>
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