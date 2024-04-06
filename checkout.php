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
                    <li><span class="step_counting">1</span><a href="restaurant.php">Choose Restaurant</a></li>
                    <li><span class="step_counting">2</span><a>Pick your favourite food</a></li>
                    <li><span class="step_counting step_counting-selected">3</span><a>Order and Pay</a></li>
                </ul>
            </div>
        </div>

        <?php
        // $dishNum = 0;
        if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['dishNum'])) {
            // user is directly ordering the item from the index page
            $dishNum = $_GET['dishNum'];
            // $res_id = $_GET['Res_id'];
            $userId = $_SESSION['user_id'];


            // sql for fetch the Dish Details
            $sql = "SELECT * FROM `dishes` WHERE `d_id` = $dishNum";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);

            if ($row == 1) {
                $row = mysqli_fetch_assoc($result);
                // $dishName = $row['title'];
                $CartSubtotal = $row['price'];
                // $dishQuantity = 1;

                // inserting the cart to thte databse's cart item table
                // $sql = "INSERT INTO `cart-items` (`cart_id`, `u_id`,`d_id`, `cart_name`, `cart_price`, `cart_quantity`, `date_of_cart`) VALUES (NULL, '$userId', '$dishNum' ,'$dishName', '$dishValue', '$dishQuantity', current_timestamp())";


            }
        } else {
            // if the user coming from the cart item
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM `cart-items` WHERE `u_id` = $user_id";
            $CartSubtotal = 0.00;
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);

            if ($row > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $CartSubtotal += floatval($row['cart_price']);
                }
                $cartSubtotal = round($CartSubtotal, 2);
            } else {
                header("location:login.php");
            }
        }
        // sending the conteol form checkout to the other page for operations
        if (isset($_GET['dishNum'])) {
            // if its a quick order
            $dishNum = $_GET['dishNum'];
            if (isset($_POST['submit']) && isset($_GET['dishNum'])) {
                header("location: quick_order.php?dishNum=$dishNum");
            }
        } else {
            // if it is a cart order 
            if (isset($_POST['submit']) && !isset($_GET['dishNum'])) {
                header("location: phpDatabase/checkout_database.php");
            }
        }

        ?>

        <div class="cart-order-box">
            <div class="container">
                <form action="" method="post">
                    <div class="cart-summary bottom-border">
                        <h1>Cart Summary</h1>
                    </div>
                    <div class="cart-subtotal bottom-border display-grid-cart-summary">
                        <p>Cart Subtotal</p>
                        <div class="cart-subtotal__price">&#8377;<span><?php echo $CartSubtotal; ?></span></div>
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
                            <h2 id="calculated-total-price">&#8377;<span><?php echo $CartSubtotal; ?></span></h2>
                        </div>
                        <div class="delivery-methods">
                            <div class="cash-on-payment">
                                <input type="radio" name="payMethod" id="cod" class="radio-input" checked>
                                <label for="cod">Cash On Delivery</label>
                            </div>
                            <div class="online-payment">
                                <input type="radio" name="payMethod" id="paypal" class="radio-input" disabled>
                                <label for="paypal">Paypal <img src="images/paypal.jpg" alt="" srcset=""></label>
                            </div>
                        </div>
                    </div>
                    <div class="place-order-btn">
                        <button type="submit" name="submit" class="btn">Place Order</button>
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
    <script src="javascript/checkout.js"></script>

</body>

</html>