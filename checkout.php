<!DOCTYPE html>
<html lang="en">

<?php
require('connection/_dbconnect.php');
session_start();
if (!(isset($_SESSION['user_id']))) {
    header("location: login.php");
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/checkout.css">
</head>

<body>

    <?php
    // includeing the navbar into the file from the already written file
    require('include/_navbar.php');
    ?>










    <!-- ============================================= RESTAURANT NAVBAR ========================================================== -->
    <div class="page-wrapper">
        <div class="restaurant_step_navbar">
            <div class="container">
                <ul class="row_links">
                    <li><span class="step_counting">1</span><a href="">Choose Restaurant</a></li>
                    <li><span class="step_counting">2</span><a href="">Pick your favourite food</a></li>
                    <li><span class="step_counting">3</span><a href="">Order and Pay</a></li>
                </ul>
            </div>
        </div>


        <div class="cart-order-box">
            <div class="container">
                <form action="" method="post">
                    <div class="cart-summary bottom-border">
                        <h1>Cart Summary</h1>
                    </div>
                    <div class="cart-subtotal bottom-border display-grid-cart-summary">
                        <p>Cart Subtotal</p>
                        <div class="cart-subtotal__price">$36</div>
                    </div>
                    <div class="dilivery-charges bottom-border display-grid-cart-summary">
                        <p>Delivery Charges</p>
                        <div class="dilivery-charges__price">
                            <p>Free</p>
                        </div>
                    </div>
                    <div class="total ">
                        <div class="toal__price display-grid-cart-summary">
                            <h2>Total</h2>
                            <h2 id="calculated-total-price">$36</h2>
                        </div>
                        <div class="delivery-methods">
                            <div class="cash-on-payment">
                                <input type="radio" name="payMethod" id="cod" class="radio-input"> 
                                <label for="cod">Cash On Delivery</label>
                            </div>
                            <div class="online-payment">
                                <input type="radio" name="payMethod" id="paypal" class="radio-input" disabled>
                                 <label for="paypal">Paypal <img src="images/paypal.jpg" alt="" srcset=""></label>
                            </div>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <button type="submit" class="btn">Place Order</button>
                    </div>
                </form>
            </div>
        </div>



    </div>








    <?php
    // including the fotte for the website from the already written file
    include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script>
    <script src="javascript/dishes.js"></script>

</body>

</html>