<!DOCTYPE html>
<html lang="en">

<?php
require('connection/_dbconnect.php');
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
    <link rel="stylesheet" href="css/yourorder.css">

</head>

<body>

    <?php
    // includeing the navbar into the file from the already written file
    require('include/_navbar.php');

    if (!isset($_SESSION['user_id'])) {
        header("location: login.php");
    }

    $uid = $_SESSION['user_id'];
    $noOrder = false;
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


        <section class="top_restaurant">
            <div class="res_details_section">
                <div class="container">
                    <div class="choose_res_heading">
                        <!-- <h1><span>Choose One </span>Restaurant</h1> -->
                    </div>
                </div>
            </div>
        </section>


        <section class="my-orders-page">
            <div class="container">
                <table>
                    <thead>
                        <tr>
                            <th class="border_left">Item</th>
                            <th class="border_left">Quantity</th>
                            <th class="border_left">Price</th>
                            <th class="border_left">Status</th>
                            <th class="border_left">Date</th>
                            <th class="border_left border_right">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- <tr>
                            <td class="border_left border_bottom">' . $itemName . '</td>
                            <td class="border_left border_bottom">' . $quantity . '</td>
                            <td class="border_left border_bottom">' . $price . '</td>
                            <td class="border_left border_bottom">' . $status . '</td>
                            <td class="border_left border_bottom">' . $date . '</td>
                            <td class="border_left border_right border_bottom" style="padding:0;padding-right: 7px;text-align: center;">
                                <div class="delete-img-dustbin">
                                    <div class="delete-img-dustbin__bg">
                                        <img src="images/dustbin.png" class="dustbin-img">
                                    </div>
                                </div>
                            </td>
                        </tr> -->
                        <!-- <?php
                                $sql = "SELECT * FROM `users_orders` WHERE `u_id` = $uid";
                                $result = mysqli_query($conn, $sql);

                                $row = mysqli_num_rows($result);
                                if ($row > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $itemName = $row['title'];
                                        $quantity = $row['quantity'];
                                        $price = $row['price'];
                                        $status = $row['status'];
                                        $date = $row['date'];

                                        echo '<tr>
                                            <td class="border_left border_bottom">' . $itemName . '</td>
                                            <td class="border_left border_bottom">' . $quantity . '</td>
                                            <td class="border_left border_bottom">' . $price . '</td>
                                            <td class="border_left border_bottom">' . $status . '</td>
                                            <td class="border_left border_bottom">' . $date . '</td>
                                            <td class="border_left border_right border_bottom" style="padding:0;padding-right: 7px;text-align: center;">
                                            <div class="delete-img-dustbin">
                                                <div class="delete-img-dustbin__bg">
                                                    <img src="images/dustbin.png" class="dustbin-img">
                                                </div>
                                            </div>
                                            </td>
                                        </tr>';
                                    }
                                } else {
                                    $noOrder = true;
                                }
                                ?> -->

                    </tbody>


                </table>
                <!-- <?php
                        if ($noOrder) {
                            echo '<div class="noOrder">
                                <h1>
                                    No Order
                                </h1>
                         </div>';
                        }
                        ?> -->
            </div>
        </section>


    </div>








    <?php
    // including the fotte for the website from the already written file
    include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script>
    <script src="javascript/your_order.js"></script>

</body>

</html>