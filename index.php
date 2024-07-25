<!DOCTYPE html>
<html lang="en">

<?php
require('connection/_dbconnect.php');

session_start();

if (isset($_SESSION['image'])) {
    $image = $_SESSION['image'];
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .allSelected {
            text-decoration: underline;
        }
    </style>
    <script>
        alert("Welcome to a sample e-commerce website! Feel free to browse, but please note that transactions are not enabled.");
    </script>
</head>

<body>

    <?php
    // includeing the navbar into the file from the already written file
    require('include/_navbar.php');
    ?>









    <!-- ======================================  HEADER============================= -->
    <header>
        <div class="container header__container">
            <div class="header__top">
                <h1>Order Delivery & Take-Out</h1>
            </div>
            <div class="header__bottom flex-display">
                <div class="stepfood step1 flex-display">
                    <div class="restaurant_img ">
                        <img src="images/restaurant.png" class="invert-img" alt="">
                    </div>
                    <div class="first_text">
                        <h3><span>1.</span> Choose Restaurant</h3>
                    </div>
                </div>
                <!-- <div class="header__arrow">
                    <img src="images/arrow-big.png" alt="">
                </div> -->
                <div class="stepfood step2 flex-display">
                    <div class="restaurant_img"><img src="images/platter.png" class="invert-img" alt=""></div>
                    <div class="first_text">
                        <h3><span>2.</span> Order Food</h3>
                    </div>
                </div>
                <!-- <div class="header__arrow">
                    <img src="images/arrow-big-dotted.png" alt="">
                </div> -->
                <div class="stepfood step3 flex-display">
                    <div class="restaurant_img">
                        <img src="images/delivery-time.png" class="invert-img" alt="">
                    </div>
                    <div class="first_text">
                        <h3><span>3.</span> Delivery Or Take Out</h3>
                    </div>
                </div>
            </div>
        </div>
    </header>










    <!-- ================================= POPULAR DISHES SECTION ========================================  -->

    <section class="popular-dishes flex-display">
        <div class="container popular-dishes__container">
            <div class="header__popular-dishes">
                <h2>Popular Dishes of the Month</h2>
                <p>Easiest Way to Order Your favourite food among these top 6 dishes</p>
            </div>
            <div class="all-popular-dishes">
                <?php
                $sql = "SELECT * FROM dishes ORDER BY odr_count DESC LIMIT 6";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_num_rows($result);

                if ($row > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['title'];
                        $slogan = $row['slogan'];
                        $price = $row['price'];
                        $img = $row['img'];
                        $dishId = $row['d_id'];
                        $res_id = $row['rs_id'];


                        echo '<article class="all-popular-dishes__article">
                                <div class="bottom__popular-dishes">
                                    <div class="dish-img" data-img_src="' . $img . '">
                                    </div>
                                    <div class="dish-info">
                                        <h5><a href="dishes.php?Res_id=' . $res_id . '">' . $title . '</a></h5>
                                        <div class="dish__description">
                                            <p>' . $slogan . '</p>
                                        </div>
                                        <div class="price-btn">
                                            <span class="price">&#8377;' . $price . '</span>
                                            <a href="checkout.php?dishNum=' . $dishId . '" class="btn">Order Now</a>
                                        </div>
                                    </div>
                                </div>
                                </article>';
                    }
                }
                ?>
            </div>
        </div>

    </section>












    <!-- =========================================================== HOW IT WORKS ============================================================================ -->
    <section class="how-it-works">
        <div class="container">
            <div class="upper__hiw">
                <div class="heading-hiw">
                    <h2>Easy to Order</h2>
                </div>

                <div class="container__hiw">
                    <div class="hiw-1">
                        <div class="hiw-step1  hiw-steps">
                            <div class="hiw-icon icon1">
                                <img src="images/restaurant.png" class="invert-img" alt="">
                            </div>
                            <div class="hiw-heading">
                                <h3>Choose a restaurant</h3>
                            </div>
                            <div class="hiw-description">
                                <p>
                                    We've got your covered with menus from a variety of delivery restaurants online.

                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="hiw__divider">
                    <div class="hiw-2">
                        <div class="hiw-step2  hiw-steps">
                            <div class="hiw-icon icon2">
                                <img src="images/platter.png" class="invert-img" alt="">
                            </div>
                            <div class="hiw-heading">
                                <h3>Choose a restaurant</h3>
                            </div>
                            <div class="hiw-description">
                                <p>
                                    We've got your covered with menus from a variety of delivery restaurants online.

                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="hiw__divider">
                    <div class="hiw-3 ">
                        <div class="hiw-step3 hiw-steps">
                            <div class="hiw-icon icon3">
                                <img src="images/delivery-time.png" class="invert-img" alt="">
                            </div>
                            <div class="hiw-heading">
                                <h3>Choose a restaurant</h3>
                            </div>
                            <div class="hiw-description">
                                <p>
                                    We've got your covered with menus from a variety of delivery restaurants online.

                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bottom__hiw">
                <p class="pay-info">
                    Cash on Delivery
                </p>
            </div>
        </div>
    </section>












    <!-- ============================================================= FEATURED RESTAURANTS ====================================================================================== -->
    <section class="featured-restaurant">
        <div class="container">
            <!-- fe__res => featured restaurant -->
            <div class="fe__res-upper flex-display">
                <div class="left-fe__res-upper">
                    <div class="res__heading">
                        <h2>Featured Restaurants</h2>
                    </div>
                </div>
                <div class="right-fe__res-upper">
                    <div class="res__listing ">
                        <ul class="res-nav__menu">
                            <li><a class="Selected allSelected res-nav__menu-li" data-filter="*">All</a></li>
                            <?php
                            $result = mysqli_query($conn, "SELECT * FROM `res_category`");
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<li><a class="select-me res-nav-list-items res-nav__menu-li " data-idNum="' . $row['c_id'] . '" data-filter="' . $row['c_name'] . '">' . $row['c_name'] . '</a></li>';
                            }

                            ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="fe__res-bottom">

                <div class="res__list">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `restaurant`");
                    while ($row = mysqli_fetch_assoc($result)) {
                        // <button onclick = "window.location.href='www.linktothepage.com';"

                        echo '<article onclick = "window.location.href = \'dishes.php?Res_id=' . $row['rs_id'] . '\'" class="select-article ' . $row['c_id'] . '">
                            <div class="res-img">
                                <img src="admin/Res_img/' . $row['image'] . '" alt="">
                            </div>
                            <div class="res-info">
                                <h4>' . $row['title']
                            . '</h4>
                                <p>' . $row['address'] . '</p>
                            </div>
                        </article>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>






    <!-- =================================== FOOTER =============================================== -->
    <?php
    // including the fotte for the website from the already written file
    include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script>

</body>

</html>