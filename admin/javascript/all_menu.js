const delete_btn = document.getElementsByClassName("all_user-action-trash")
const edit_btn = document.getElementsByClassName("all_user-action-edit")

// Deleting the dish when we click on the delete button
Array.from(delete_btn).forEach((value) => {
    value.addEventListener('click', () => {
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
                location.reload();
            }
        })

    })
})





