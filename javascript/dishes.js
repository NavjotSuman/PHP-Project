
// ============================================ displaying the cart from the ============================================
let DishTotalPrice = 0.00;
carted_dishes = document.querySelector(".carted_dishes");
let show_cart = () => {
    carted_dishes.innerHTML = "";
    fetch('show-cart.php')
        .then((Response) => {
            return Response.json();
        })
        .then((data) => {
            DishTotalPrice = 0.00;
            for (let i = 0; i < data.length; i++) {
                var cartName = data[i].cart_name;
                var cartPrice = data[i].cart_price;
                var cartQuantity = data[i].cart_quantity;
                // console.log(ParseInt(cartPrice))
                // this total price is used in settimeout for dynamic calculation of price

                carted_dishes.innerHTML += `<article class="widget-body" >
                <div class="title-row">
                <div class="cart_dish_name">${cartName}</div>
                <a><img src="images/dustbin.png" alt=""></a>
                </div>
                <div class="dish_price-quantity">
                <div class="dish_price">$<span>${cartPrice}</span></div>
                <div class="dish_quantity">${cartQuantity}</div>
                </div>
                </article >`;

                DishTotalPrice += parseFloat(cartPrice);
            }
        })


    setTimeout(() => {
        let total_price = () => {
            // dishPrice = document.getElementsByClassName("dish_price");
            cartTotal = document.querySelector(".cart_total__details-price");
            // dishPrice = Array.from(dishPrice);
            // dishPrice.forEach((value) => {
            //     DishTotalPrice += value.firstElementChild.innerHTML;
            // })
            cartTotal.firstElementChild.innerHTML = DishTotalPrice;
        }
        total_price();
    }, 100);
}
show_cart();















// ============================================= inserting the cart to databse ====================================
let addCart = document.getElementsByClassName("add-to-card-btn");
Array.from(addCart).forEach((value) => {

    value.addEventListener('click', () => {

        // Seetced Dish-Name
        dishName = value.parentElement.parentElement.firstElementChild.lastElementChild.firstElementChild.innerHTML;

        // selected Dish Value/Price
        dishValue = value.parentElement.firstElementChild.firstElementChild.firstElementChild.firstElementChild.innerHTML;

        // Selected Dish Quantity
        dishQuantity = value.parentElement.firstElementChild.lastElementChild.firstElementChild.value;

        // console.log(dishQuantity)

        uid = 1;


        // using fetch
        let cartSelected = {
            "uid": `${uid}`,
            "dishName": `${dishName}`,
            "dishValue": `${dishValue}`,
            "dishQuantity": `${dishQuantity}`,
        }

        fetch('cart-insert.php', {
            method: "POST",
            body: JSON.stringify(cartSelected),
            headers: {
                "Content-type": "application/json",
            }
        }).then((Response) => {
            return (Response.json());
        }).then((result) => {
            if (result.insert != 'success') {
                console.log("data Can't be inserted");
            }
        }).catch((error) => {
            console.log("there is an ", error);
        });
        setTimeout(() => {
            show_cart();
        }, 200);
    })
})


