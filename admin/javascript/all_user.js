let usersRow = document.getElementById("display_users_detail");
let userModal = document.querySelector(".update_user-modal");
let closeModal_Btn = document.querySelector(".cancle-btn");
let updateModal_Btn = document.querySelector(".submit-btn");
let modalForm = document.getElementById("modal-form");
// console.log("this is ", updateModal_Btn)



// ============================ MODAL modal ============================================================

/* 
    * Actions Perform After the Modal gets Open 
*/


// opening the model whenever we click on the edit pen icon in the table of the all_users.php
let onEditClick = () => {
    let edit_button = document.getElementsByClassName("all-user-edit");

    Array.from(edit_button).forEach((value) => {
        value.addEventListener('click', () => {

            // opening the modal whenever we click on the edit pen icon of the user table 
            userModal.style.display = "block";

            // updating the modal with the user info
            let EditId = value.getAttribute("data-user_id");
            let fetchValues = {
                "uid": `${EditId}`,
            }
            fetch("operations-file/all_user-modal_fetch.php", {
                method: "POST",
                body: JSON.stringify(fetchValues),
                headers: {
                    "Content-type": "application/json",
                }
            }).then((Response) => {
                return Response.json();
            }).then((data) => {
                let username = data[0].username;
                let first_name = data[0].f_name;
                let last_name = data[0].l_name;
                let email = data[0].email;
                let phone = data[0].phone;
                let address = data[0].Address;
                let date = data[0].date;

                modalForm.firstElementChild.lastElementChild.setAttribute("value", `${username}`)
                document.getElementById("f_name").setAttribute("value", `${first_name}`)
                document.getElementById("l_name").setAttribute("value", `${last_name}`)
                document.getElementById("email").setAttribute("value", `${email}`)
                document.getElementById("phone").setAttribute("value", `${phone}`)
                document.getElementById("Address").setAttribute("value", `${address}`)
                document.getElementById("doj").setAttribute("value", `${date}`)
            })




            // closing and Opening the modal on click on the close/update button of the modal
            closeModal_Btn.addEventListener('click', () => {
                setTimeout(() => {
                    userModal.style.display = "none";
                    modalForm.reset();
                }, 10);
            })


            // on click on the update button of the modal
            updateModal_Btn.addEventListener('click', () => {
                console.log("hi");
                let username = document.getElementById("username").value;
                let firstName = document.getElementById("f_name").value;
                let lastName = document.getElementById("l_name").value;
                let email = document.getElementById("email").value;
                let phone = document.getElementById("phone").value;
                let address = document.getElementById("Address").value;
                let doj = document.getElementById("doj").value;
                let fetchValues = {
                    "uid": `${EditId}`,
                    "username": `${username}`,
                    "firstName": `${firstName}`,
                    "lastName": `${lastName}`,
                    "email": `${email}`,
                    "phone": `${phone}`,
                    "address": `${address}`,
                    "doj": `${doj}`,
                }
                fetch("operations-file/all_user-modal-update.php", {
                    method: "POST",
                    body: JSON.stringify(fetchValues),
                    headers: {
                        "Content-type": "application/json",
                    }
                }).then((Response) => {
                    return Response.json();
                }).then((value) => {
                    if (value.updated == 'success') {
                        console.log(`User Updated Successfully`)

                        setTimeout(() => {
                            userModal.style.display = "none";
                            modalForm.reset();
                            show_user_account();
                        }, 10);
                    }
                    else {
                        console.log("there is somthing different in the all user update section")
                    }
                })
            })

            // console.log("address");


        })
    })





}





// delete the uer account and refresh the table that displaying the user account without refresh the web-page
let onDeleteClick = () => {
    let delete_button = document.getElementsByClassName("all-user-delete");

    Array.from(delete_button).forEach((value) => {
        value.addEventListener('click', () => {
            let delete_Id = value.getAttribute("data-user_id");
            // console.log(delete_Id);
            let fetchValues = {
                "uid": `${delete_Id}`,
            }
            fetch("operations-file/all_user-delete.php", {
                method: "POST",
                body: JSON.stringify(fetchValues),
                headers: {
                    "Content-type": "application/json",
                }
            }).then((Response) => {
                return (Response.json());
            }).then((result) => {
                if (result.deleted == 'success') {
                    console.log(`User Deleted Successfully`);
                    show_user_account();
                }
                else {
                    console.log("User is not deleted");
                }
            }).catch((error) => {
                console.log("There is an error in delete User page");
            })
        })
    })

}





// ============================ show all user accounts to admin panel ====================================== 
let show_user_account = () => {
    usersRow.innerHTML = "";
    fetch("operations-file/all_user-fetch.php")
        .then((Response) => {
            return Response.json();
        }).then((array) => {
            // console.log(array);
            for (let i = 0; i < array.length; i++) {
                let username = array[i].username;
                let first_name = array[i].f_name;
                let last_name = array[i].l_name;
                let email = array[i].email;
                let phone = array[i].phone;
                let address = array[i].address;
                let date = array[i].date;
                let user_id = array[i].u_id;

                // console.log(username);

                usersRow.innerHTML += `<tr>
                                            <td>${username}</td>
                                            <td>${first_name}</td>
                                            <td>${last_name}</td>
                                            <td>${email}</td>
                                            <td>${phone}</td>
                                            <td>${address}</td>
                                            <td>${date}</td>
                                            <td class="action_data">
                                                <a class="all_user-action all-user-delete all_user-action-trash" data-user_id="${user_id}"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                                <a class="all_user-action all_user-action-edit all-user-edit" data-user_id="${user_id}"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                            </td>
                                        </tr>`;


            }

            onDeleteClick();
            onEditClick();

        })
}







show_user_account();

// console.log(edit_button)
