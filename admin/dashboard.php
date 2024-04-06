<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
}
require '../connection/_dbconnect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navjot</title>

    <link rel="stylesheet" href="css/style.css">

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">


</head>

<body>
    <?php include 'include/_navbar.php'; ?>



    <!-- dashboard main started here -->
    <div class="dashboard-main">
        <header>
            <aside>
                <div class="aside__container">
                    <div class="aside__container-top">
                        <ul class="aside-dashboard">
                            <h4>HOME</h4>
                            <li class="flex-aside-li"><a href="dashboard.php"><img class="aside-img" src="images/icons/gauge-high-solid.png" alt="" srcset=""><span>Dashboard</span></a></li>
                        </ul>
                    </div>


                    <div class="aside__container-bottom">
                        <div class="admin-controler-links">
                            <ul class="aside-admin">
                                <h4>LOG</h4>
                                <li class="flex-aside-li list-bg"><a href="all_users.php" class="flex-anchor"><img class="aside-img" src="images/icons/user-solid.png" alt="" srcset=""><span>Users</span></a></li>
                                <li class="flex-aside-li list-bg hidden-off">
                                    <a class="flex-anchor"><img class="aside-img" src="images/icons/box-archive-solid.png" alt="" srcset=""><span>Restaurant</span><img src="images/icons/greater-than-solid.png" class="arraw-img" alt="" srcset="">
                                    </a>
                                    <ul hidden class="hidden-div">
                                        <li><a href="all_restaurant.php"><span>All Restaurant</span></a></li>
                                        <li><a href="all_restaurant-add_category.php"><span>Add Category</span></a></li>
                                        <li><a href="add_restaurant.php"><span>Add Restaurant</span></a></li>
                                    </ul>
                                </li>
                                <li class="flex-aside-li list-bg hidden-off">
                                    <a class="flex-anchor"><img class="aside-img " src="images/icons/utensils-solid.png" alt="" srcset=""><span>Menu</span><img src="images/icons/greater-than-solid.png" class="arraw-img" alt="" srcset=""></a>
                                    <ul hidden class="hidden-div">
                                        <li><a href="all_menu.php"><span>All Menus</span></a></li>
                                        <li><a href="add_menu.php"><span>Add Menus</span></a></li>
                                    </ul>
                                </li>
                                <li class="flex-aside-li list-bg"><a href="all_orders.php" class="flex-anchor"><img class="aside-img" src="images/icons/cart-shopping-solid.png" alt="" srcset=""><span>Orders</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>


            <!--  ================================================================================ right side of the dashboard ================================================================================= -->

            <?php
            // total users
            $sql = "SELECT * FROM `users`";
            $result = mysqli_query($conn, $sql);
            $total_users = mysqli_num_rows($result);

            // total dishes
            $sql = "SELECT * FROM `dishes`";
            $result = mysqli_query($conn, $sql);
            $total_dishes = mysqli_num_rows($result);

            // total restaurant
            $sql = "SELECT * FROM `restaurant`";
            $result = mysqli_query($conn, $sql);
            $total_restaurant = mysqli_num_rows($result);

            // total restaurant categories
            $sql = "SELECT * FROM `res_category`";
            $result = mysqli_query($conn, $sql);
            $total_restaurant_categories = mysqli_num_rows($result);

            // total orders
            $sql = "SELECT * FROM `users_orders`";
            $result = mysqli_query($conn, $sql);
            $total_orders = mysqli_num_rows($result);

            // processing order
            $sql = "SELECT * FROM `users_orders` WHERE `status` LIKE 'in process'";
            $result = mysqli_query($conn, $sql);
            $total_processing = mysqli_num_rows($result);

            // Order delivered
            $sql = "SELECT * FROM `users_orders` WHERE `status` LIKE 'closed'";
            $result = mysqli_query($conn, $sql);
            $total_delivered = mysqli_num_rows($result);

            // order canceled
            $sql = "SELECT * FROM `users_orders` WHERE `status` LIKE 'rejected'";
            $result = mysqli_query($conn, $sql);
            $canceled_order = mysqli_num_rows($result);

            // total earning
            $total_earning = 0;
            $sql = "SELECT * FROM `users_orders` WHERE `status` LIKE 'closed'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_num_rows($result);
            if ($row > 0) {
                $sum = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $price_value = $row['price'];
                    $price_value = floatval($price_value);

                    $quantity_order = $row['quantity'];
                    $quantity_order = intval($quantity_order);
                    if ($quantity_order > 1) {
                        $price_value = $price_value * $quantity_order;
                    }
                    // converting string to float
                    $sum += $price_value;

                    // echo var_dump($price_value), "<br>";
                }
                // float upto 2 decimal numbers only
                $total_earning = number_format($sum, 2, '.', '');
            }

            ?>





            <div class="main-right-display">
                <div class="marqueetag">
                    <!-- write the marquee here -->
                    <marquee behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eos sed aliquid culpa distinctio nostrum sequi a quas. Harum omnis at nobis amet deserunt sapiente totam provident laudantium officiis illum?</marquee>
                </div>
                <div class="admin__dashboard">
                    <div class="admin__dashboard-container">

                        <div class="dashboard__header">
                            <h4>Admin Dashboard</h4>
                        </div>


                        <!-- first row in admin dashboard -->
                        <div class="admin__dashboard-row">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/house-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_restaurant ?></h2>
                                        <p>Restaurant</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/utensils-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_dishes; ?></h2>
                                        <p>Dishes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/users-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_users; ?></h2>
                                        <p>Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/cart-shopping-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_orders; ?></h2>
                                        <p>Total Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- second row in admin dashboard -->
                        <div class="admin__dashboard-row">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/table-cells-large-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_restaurant_categories; ?></h2>
                                        <p>Restro Categories</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/spinner-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_processing; ?></h2>
                                        <p>Processing Orders</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/check-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $total_delivered; ?></h2>
                                        <p>Delivered Orders</p>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- last and the third row i the admin dashboard -->
                        <div class="admin__dashboard-row">
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/xmark-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><?php echo $canceled_order; ?></h2>
                                        <p>Cancelled Orders</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="media">
                                    <div class="media-left">
                                        <img src="images/icons/dollar-sign-solid.png" alt="" srcset="" class="admin__dashboard-img">
                                    </div>
                                    <div class="media-right">
                                        <h2><span>&#8377;<span><?php echo $total_earning; ?></h2>
                                        <p>Total Earning</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    </div>


    <?php
    include 'include/_footer.php';
    ?>




    <script src="javascript/script.js"></script>
</body>

</html>