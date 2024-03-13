let orderRow = document.getElementById("display_orders_detail");


let onDeleteClick = () =>{
    
}



// ============================ show all user accounts to admin panel ====================================== 
let show_orders = () => {
    orderRow.innerHTML = "";
    fetch("operations-file/all_orders-fetch.php")
        .then((Response) => {
            return Response.json();
        }).then((array) => {
            console.log(array);
            for (let i = 0; i < array.length; i++) {
                let username = array[i].username;
                let address = array[i].address;
                let title = array[i].title;
                let quantity = array[i].quantity;
                let price = array[i].price;
                let status = array[i].status;
                let date = array[i].date;
                let oid = array[i].date;

                console.log(username);
                console.log(address);
                console.log(title);
                console.log(price);
                console.log(quantity);
                console.log(status);
                console.log(date);
                console.log(oid);

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

            // onDeleteClick();
            // onEditClick();

        })
}


show_orders();