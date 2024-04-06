let DishTotalPrice = 0.00;
let carted_dishes = document.querySelector(".carted_dishes");

// ============================================ displaying the cart from the database ============================================
let show_cart = () => {
    DishTotalPrice = 0.00;
    carted_dishes.innerHTML = "";
    fetch('show-cart.php')
        .then((Response) => {
            return Response.json();
        })
        .then((data) => {
            for (let i = 0; i < data.length; i++) {
                var cartName = data[i].cart_name;
                var cartPrice = data[i].cart_price;
                var cartQuantity = data[i].cart_quantity;
                // console.log(ParseInt(cartPrice))
                // this total price is used in settimeout for dynamic calculation of price

                carted_dishes.innerHTML += `<article class="widget-body" >
                <div class="title-row">
                <div class="cart_dish_name">${cartName}</div>
                <a><img src="images/dustbin.png"  alt="" style="filter: invert(15%) sepia(0%) saturate(45%) hue-rotate(176deg) brightness(91%) contrast(82%); width: 0.9rem;"></a>
                </div>
                <div class="dish_price-quantity">
                <div class="dish_price">&#8377;<span>${cartPrice}</span></div>
                <div class="dish_quantity">${cartQuantity}</div>
                </div>
                </article >`;

                DishTotalPrice += parseFloat(cartPrice);
            }
        }).catch((error) => {
            console.log("You Have No Cart");
        })


    // ========================================================================= Using dustbin for delete the carted item from te list =========================================================.

    setTimeout(() => {
        let delete_item_row = document.getElementsByClassName("title-row")

        Array.from(delete_item_row).forEach((value) => {
            value.lastElementChild.addEventListener('click', () => {

                // scroll location
                let scrollY = (window.scrollY) + 200;

                let DeleteModal = document.querySelector(".deleteModalStartHere");
                DeleteModal.style.top = `${scrollY}px`;
                // DeleteModal.style.left = "10%";
                DeleteModal.style.display = "block";
                DeleteModal.style.animationName = "start-deleteConfirmModal";
                DeleteModal.style.animationDuration = "400ms";

                // fetching the Confirm Button of The Delete Order modal
                let confirmDelete = document.querySelector(".confirm-btn");

                // fetching the Cancel Button of The Delete Order modal
                let CancelDelete = document.querySelector(".cancel-btn");

                // on Click Confirm of the Deete order modal
                confirmDelete.addEventListener('click', () => {

                    let delete_item_name = value.firstElementChild.innerHTML;

                    let deleteItemNameJson = {
                        "delete_item": `${delete_item_name}`,
                    }
                    fetch('delete_cart.php', {
                        method: "POST",
                        body: JSON.stringify(deleteItemNameJson),
                        headers: {
                            "Content-type": "application/json",
                        }
                    }).then((Response) => {
                        return (Response.json());
                    }).then((result) => {
                        if (result.deleted == 'success') {
                            console.log(`Item ${delete_item_name} Deleted Successfully`)
                            // hiding the Delete Confirm Modal
                            DeleteModal.style.animationName = "hide-deleteConfirmModal";
                            DeleteModal.style.animationDuration = "300ms";

                            setTimeout(() => {
                                DeleteModal.style.display = "none";
                            }, 280);
                        }
                        show_cart();
                    }).catch((error) => {
                        console.log("error is in the dustbin section of the dishes section")
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
    }, 50);

    // ========================== displaying the total price of the carted items... ===============================

    setTimeout(() => {
        let total_price = () => {
            // dishPrice = document.getElementsByClassName("dish_price");
            cartTotal = document.querySelector(".cart_total__details-price");
            // dishPrice = Array.from(dishPrice);
            // dishPrice.forEach((value) => {
            //     DishTotalPrice += value.firstElementChild.innerHTML;
            // })
            cartTotal.firstElementChild.innerHTML = DishTotalPrice;

            localStorage.setItem("dishTotalPrice", DishTotalPrice);
            // console.log(typeof DishTotalPrice, DishTotalPrice)

            var CheckOutButton = document.querySelector(".cart_total__details-buy_btn").firstElementChild;
            if (DishTotalPrice == 0) {
                // CheckOutButton.style.
                // console.log(CheckOutButton)
                CheckOutButton.style.backgroundColor = "#da625e";
                CheckOutButton.style.borderColor = "#da625e";

                CheckOutButton.addEventListener('mouseenter', () => {
                    CheckOutButton.style.backgroundColor = "#da625e";
                    CheckOutButton.style.cursor = "context-menu";
                })
                CheckOutButton.addEventListener('mouseleave', () => {
                    CheckOutButton.style.backgroundColor = "#da625e";
                })

                if (CheckOutButton.hasAttribute("href")) {
                    CheckOutButton.removeAttribute("href");
                }
            }
            else {
                CheckOutButton.style.backgroundColor = "#449d44";
                CheckOutButton.style.borderColor = "#419641";

                CheckOutButton.setAttribute("href", "checkout.php")

                CheckOutButton.addEventListener('mouseenter', () => {
                    CheckOutButton.style.backgroundColor = "#207020";
                    CheckOutButton.style.cursor = "pointer";
                })

                CheckOutButton.addEventListener('mouseleave', () => {
                    CheckOutButton.style.backgroundColor = "#449d44";
                })

            }

            // console.log(typeof DishTotalPrice, DishTotalPrice);
        }
        total_price();
    }, 100);


}
show_cart();















// ============================================= inserting the cart to databse ====================================
let addCart = document.getElementsByClassName("add-to-card-btn");
Array.from(addCart).forEach((value) => {

    value.addEventListener('click', () => {

        // will be 0 if not logged
        let UserLogged = value.firstElementChild.getAttribute("data-user");

        if (UserLogged == 0) {
            window.location.href = "login.php";
        }

        // Seetced Dish-Name
        dishName = value.parentElement.parentElement.firstElementChild.lastElementChild.firstElementChild.innerHTML;

        // selected Dish Value/Price
        dishValue = value.parentElement.firstElementChild.firstElementChild.firstElementChild.firstElementChild.innerHTML;

        // Selected Dish Quantity
        dishQuantity = value.parentElement.firstElementChild.lastElementChild.firstElementChild.value;
        value.parentElement.firstElementChild.lastElementChild.firstElementChild.value = "1";

        // fetching the Dishid of the cart
        dishId = value.getAttribute("data-dishid");

        // console.log(dishId);
        // console.log(dishQuantity)


        // using fetch
        let cartSelected = {
            "dishName": `${dishName}`,
            "dishValue": `${dishValue}`,
            "dishQuantity": `${dishQuantity}`,
            "dishId": `${dishId}`,
        }

        fetch('cart-insert.php', {
            method: "POST",
            body: JSON.stringify(cartSelected),
            headers: {
                "Content-type": "application/json",
            }
        }).then((Response) => {
            return Response.json();
        }).then((result) => {
            // if (result.insert != 'success') {
            //     console.log("data Can't be inserted");
            // }
            console.log("success")
        }).catch((error) => {
            console.log("there is an ", error);
            // window.location.href = "login.php";
        });
        setTimeout(() => {
            show_cart();
        }, 100);
    })
})







