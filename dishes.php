<!DOCTYPE html>
<html lang="en">

<?php
require('connection/_dbconnect.php');
session_start();

$user_id = 0;
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/dishes.css">
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
                    <li><span class="step_counting step_counting-selected">2</span><a>Pick your favourite food</a></li>
                    <li><span class="step_counting">3</span><a>Order and Pay</a></li>
                </ul>
            </div>
        </div>
        <?php

        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $res_id = $_GET['Res_id'];
            $sql = "SELECT * FROM `restaurant` WHERE `rs_id` = $res_id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
        }
        echo '<section class="top_restaurant">
            <div class="res_details_section">
                <div class="container">
                    <div class="res_dishes_header">
                        <article>
                            <div class="res_img">
                                <img src="admin/Res_img/' . $row['image'] . '" alt="">
                            </div>
                            <div class="res_details">
                                <h2>' . $row['title'] . '</h2>
                                <p>' . $row['address'] . '</p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>';
        ?>
    </div>













    <!-- ============================================================================= DISHES MENU ======================================================================= -->
    <!-- modal for confirm the order for delete the order  -->
    <div class="deleteModalStartHere">
        <div class="delete_confirm-modal">
            <div class="delete_confirm-modal_container">
                <div class="delete_modal-row1">
                    <h2>CART DELETE</h2>
                </div>
                <div class="delete_modal-row2">
                    <P>Are You Sure??</P>
                </div>
                <div class="delete_modal-row3">
                    <a class="btn confirm-btn">CONFIRM</a>
                    <a class="btn cancel-btn">CANCEL</a>
                </div>
            </div>
        </div>
    </div>


    <div class="dish_menu-cart">
        <div class="container">
            <section class="dish_menu-cart-left">
                <div class="cart__heading">
                    <h2>Your Cart</h2>
                </div>
                <div class="carted_dishes">
                    <!-- <article class="widget-body">
                        <div class="title-row">
                            <div class="cart_dish_name">Yorkshire Lamb Patties</div>
                            <a><img src="images/dustbin.png" alt=""></a>
                        </div>
                        <div class="dish_price-quantity">
                            <div class="dish_price">$14.00</div>
                            <div class="dish_quantity">1</div>
                        </div>
                    </article> -->
                </div>
                <div class="cart_total__details flex-display">
                    <div class="cart_total__details-heading">
                        <h2>TOTAL</h2>
                    </div>
                    <div class="cart_total__details-price">
                        &#8377;<span>0</span>
                    </div>
                    <div class="cart_total__details-delivery_system">
                        <h3>Free Delivery!</h3>
                    </div>
                    <div class="cart_total__details-buy_btn">
                        <a class="btn">Check Out</a>
                    </div>
                </div>
            </section>



            <section class="dish_menu-cart-right">
                <div class="dish_menu-cart-right__heading">
                    <h2>MENU</h2>
                    <div class="pull-btn">
                        <img src="" alt="">
                    </div>
                </div>
                <div class="dish_menu-cart-right__all-dishes">
                    <?php
                    if ($_SERVER['REQUEST_METHOD'] == "GET") {
                        $res_id = $_GET['Res_id'];
                        $sql = "SELECT * FROM `dishes` WHERE `rs_id` = $res_id";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {


                            echo '
                            <article class="dishes__menu">
                                <div class="dishes__menu-left">
                                    <div class="dish__img-left">
                                        <img src="admin/Res_img/dishes/' . $row['img'] . '" alt="">
                                    </div>
                                    <div class="dish__details">
                                        <h2>' . $row['title'] . '</h2>
                                        <p>' . $row['slogan'] . '</p>
                                    </div>
                                </div>
                                <div class="dishes__menu-right">
                                    <div class="dishes__menu-right-price">
                                        <div class="dishes__menu_price">
                                            <h2>&#8377;<span>' . $row['price'] . '</span></h2>
                                        </div>

                                        <div class="dishes__menu_counting">
                                            <input type="text" value="1">
                                        </div>
                                    </div>
                                    <div class="add-to-card-btn btn" data-dishid="' . $row['d_id'] . '">
                                        <a data-user=' . $user_id . '>Add To Cart</a>
                                    </div>
                                </div>
                            </article>
                            <div class="space-between-articles"></div>';
                        }
                    }


                    ?>

                </div>

            </section>
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