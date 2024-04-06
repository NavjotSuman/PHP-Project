const delete_btn = document.getElementsByClassName("all_user-action-trash")
const edit_btn = document.getElementsByClassName("all_user-action-edit")

// Deleting the dish when we click on the delete button
Array.from(delete_btn).forEach((value) => {
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

            let dishId = value.getAttribute("data-dish_number");

            let fetchValues = {
                "dishId": `${dishId}`,
            }

            fetch("operations-file/all_menu-delete_btn.php", {
                method: "post",
                body: JSON.stringify(fetchValues),
                headers: {
                    "Content-type": "application/json",
                }
            }).then((Response) => {
                return Response.json();
            }).then((data) => {
                if (data.deleted == "successfully") {

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
})





