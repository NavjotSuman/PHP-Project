let delete_btn = document.getElementsByClassName("action-trush_button");
delete_btn = Array.from(delete_btn);

let onDeleteClick = () => {
    delete_btn.forEach(value => {
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

                let catId = value.getAttribute("data-cat_number");
                console.log(catId);
                let fetchValues = {
                    "catid": `${catId}`,
                }

                fetch("operations-file/all_restaurant-add_category-delete.php", {
                    method: "POST",
                    body: JSON.stringify(fetchValues),
                    headers: {
                        "Content-type": "application/json",
                    }
                }).then((Response) => {
                    return (Response.json());
                }).then((result) => {
                    if (result.deleted == 'success') {
                        // hiding the Delete Confirm Modal
                        DeleteModal.style.animationName = "hide-deleteConfirmModal";
                        DeleteModal.style.animationDuration = "300ms";

                        setTimeout(() => {
                            DeleteModal.style.display = "none";
                            location.reload();
                        }, 280);
                    }
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
    });
}

onDeleteClick();

let addCategory = () => {
    const add_button = document.querySelector(".add_button").firstElementChild;
    const cat_input = document.querySelector("#category");
    // console.log(add_button);
    add_button.addEventListener('click', (e) => {
        e.preventDefault();
        let cat_inputValue = cat_input.value;
        // console.log(cat_inputValue);
        fetchValues = {
            "cat_inputValue": `${cat_inputValue}`,
        }

        fetch("operations-file/all_restaurant-add_category-insert.php", {
            method: "post",
            body: JSON.stringify(fetchValues),
            headers: {
                "Content-type": "application/json",
            }
        }).then((Response) => {
            return Response.json();
        }).then((data) => {
            if (data.added = "successfully") {
                location.reload();
            }

        }).catch((error) => {
            let form = document.querySelector("#form");
            let input_valueExisted = form.firstElementChild.lastElementChild;

            input_valueExisted.removeAttribute("hidden");


        })
    })
}

addCategory();



// on click edit button of the category table
let onEditClick = () => {
    let editCategory = document.getElementsByClassName("action-edit_button");
    Array.from(editCategory).forEach((value) => {
        value.addEventListener('click', () => {
            // category nmber
            let catId = value.getAttribute("data-cat_number");

            // let scrollX = window.scrollX;
            let scrollY = (window.scrollY);

            // making display of the modal block
            document.querySelector(".modal-update_category").style.top = `${scrollY}px`;
            document.querySelector(".modal-update_category").style.display = "block";
            // scrool to the top and it will be smooth scroll

            // window.scrollTo(0, 0)


            // update modal 
            let update_btn = document.querySelector(".update_button");
            let update_category = document.querySelector("#update_category");
            update_category.value = value.parentElement.parentElement.firstElementChild.nextElementSibling.innerHTML;
            update_btn.addEventListener('click', (e) => {
                e.preventDefault();
                let updateInputValue = update_category.value;
                console.log(updateInputValue);
                let fetchValues = {
                    "catId": `${catId}`,
                    "catInput": `${updateInputValue}`,
                }
                fetch("operations-file/all_restaurant-add_category-update.php", {
                    method: "post",
                    body: JSON.stringify(fetchValues),
                    headers: {
                        "Content-type": "application/json",
                    }
                }).then((Response) => {
                    return Response.json();
                }).then((data) => {
                    if (data.updated == "success") {
                        location.reload();
                    }
                })
            })



            // on click on the cancle button
            let modalClose = document.querySelector(".modal-close");
            modalClose.addEventListener('click', () => {

                document.querySelector(".modal-update_category").style.display = "none";
            })



        })
    })
}
onEditClick();

// update


let updateCategory = () => {
    let update_btn = document.querySelector(".update_button");
    let update_category = document.querySelector("#update_category");

    update_btn.addEventListener('click', (e) => {
        e.preventDefault();

        let updateInputValue = updateCategory.value;
    })
}
