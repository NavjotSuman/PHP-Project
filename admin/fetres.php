<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// if (!isset($_SESSION['admin_id'])) {
//     header("location: index.php");
// }
$search_details = false;
require '../connection/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $search_details = true;
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navjot</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all_users.css">
    <!-- <link rel="stylesheet" href="css/all_user-modal.css"> -->
    <link rel="stylesheet" href="css/all_restaurant.css">
    <link rel="stylesheet" href="css/all_order.css">
    <link rel="stylesheet" href="css/search_orders.css">

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
            <?php
            include 'include/_mainAside.php';
            ?>


            <!--  ================================================================================ right side of the dashboard ================================================================================= -->
            <div class="main-right-display">
                <?php
                include 'include/_marquee_info.php';
                ?>

                <!-- <div class="marqueetag">
                    write the marquee here
                    <marquee behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eos sed aliquid culpa distinctio nostrum sequi a quas. Harum omnis at nobis amet deserunt sapiente totam provident laudantium officiis illum?</marquee>
                </div> -->



                <div class="update_restaurant-modal">
                    <div class="modal__container">
                        <div class="modal-start">
                            <div class="modal-heading" style="padding:0 0 3rem 0; background-color: transparent;">
                                <h2 style="color: #212223;">Search Order</h2>
                                <hr>
                            </div>
                            <!-- action="operations-file/all_restaurant_modal-update.php" -->
                            <form id="modal-form" method="post" enctype="multipart/form-data">

                                <div class="last_row rows_b-margin">
                                    <label for="orderStatus">Order Status</label><br>
                                    <select name="orderStatus" class="input-box custom-box" id="orderStatus">
                                        <option value selected disabled>--Select Status--</option>
                                        <!-- fetching the categories using php -->
                                        <option value="Order Placed">Order Placed</option>
                                        <option value="Dispatched">Dispatched</option>
                                        <option value="On The Way">On the way</option>
                                        <option value="Delivered">Delivered</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>

                                <div class="first_row grid-row rows_b-margin">
                                    <div class="res_name">
                                        <label for="fromDate">From Date</label><br>
                                        <input type="date" class="input-box" name="fromDate" id="fromDate">
                                    </div>
                                    <div class="buss_email">
                                        <label for="toDate">To Date</label><br>
                                        <input type="date" class="input-box" name="toDate" id="toDate">
                                    </div>
                                </div>

                                <div class="second_row grid-row rows_b-margin">
                                    <div class="phone">
                                        <label for="fromTime">From Time</label><br>
                                        <input type="time" class="input-box" name="fromTime" id="fromTime">
                                    </div>
                                    <div class="website_url">
                                        <label for="toTime">To Time</label><br>
                                        <input type="time" class="input-box" name="toTime" id="toTime">
                                    </div>
                                </div>

                                <div class="modal-buttons" style="display: flex;">
                                    <a class="update-btn btn odr_search-btn search-details-btn" style="background-color: red; border:1px solid red;" data-show="">Details</a>
                                    <button type="submit" class="update-btn btn odr_search-btn" value="ADD" name="submit" required>Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="all_search_order">

                    <div class="admin__dashboard" style="padding: 2.5rem .5rem 1rem .5rem;">
                        <div class="admin__dashboard-container">

                            <div class="dashboard__header">
                                <h4>All Order</h4>
                            </div>





                            <!-- <div class="searchDetailsModal">
                                <div class="searchModal-startHere">
                                    <div class="searchDetailsModal_container">
                                        <div class="searchDetailsModal_heading">
                                            <h2>Order Details</h2>
                                        </div>
                                        <div class="searchDetailsModal_table">
                                            <table>

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->




                            <!-- first row in admin dashboard -->

                            <div class="all_users-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <td>User</td>
                                            <td>Title</td>
                                            <td>Quantity</td>
                                            <td>Price</td>
                                            <td>Address</td>
                                            <td style="width: 18%;">Status</td>
                                            <td>Order Date</td>
                                            <td style="width: 12%;">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody id="display_orders_detail">

                                        <?php

                                        // operation after click on the ADD Button
                                        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
                                            $search_totalEarning = 0.00;
                                            $search_totalOrders = 0;
                                            $search_placedOrders = 0;
                                            $search_dishpatchedOrders = 0;
                                            $search_onthewayOrders = 0;
                                            $search_DeliveredOrders = 0;
                                            $search_cancelledOrders = 0;

                                            // for all conditions
                                            if (!empty($_POST['orderStatus'])) {
                                                $order_status = $_POST['orderStatus'];
                                            }
                                            $search_fromDate = "2024-01-01";
                                            $search_toDate = date("Y-m-d"); //is a string by default
                                            $search_fromTime = "00:00:00";
                                            $search_toTime = "23:59:59";
                                            // echo "submited";

                                            // $navjot = true;

                                            if (!empty($_POST['orderStatus']) && empty($_POST['fromDate']) && empty($_POST['toDate']) && empty($_POST['fromTime']) && empty($_POST['toTime'])) {

                                                $order_status = $_POST['orderStatus'];
                                                // echo "<br>order Status";
                                                // echo " ", $_POST['orderStatus'];

                                                $sql = "SELECT * FROM `users_orders` WHERE `status` = '$order_status' ORDER BY `o_id` DESC";

                                                $result = mysqli_query($conn, $sql);
                                                if ($result) {
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $odr_id = $row['o_id'];
                                                            $usr_id = $row['u_id'];
                                                            $title = $row['title'];
                                                            $quantity = $row['quantity'];
                                                            $cancel_reason = $row['can_reason'];
                                                            $price = $row['price'];
                                                            $status = $row['status'];
                                                            $date = $row['date'];
                                                            $search_totalOrders = $search_totalOrders + 1;

                                                            $user_sql = "SELECT * FROM `users` WHERE `u_id` = $usr_id";
                                                            $user_result = mysqli_query($conn, $user_sql);
                                                            if ($user_result) {
                                                                if (mysqli_num_rows($user_result) == 1) {
                                                                    $user_row = mysqli_fetch_assoc($user_result);

                                                                    $usr_name = $user_row['username'];
                                                                    $usr_address = $user_row['address'];
                                                                }
                                                            }

                                                            // counting the totol Earning of the searched Orders
                                                            if ($status == "Delivered") {
                                                                $search_totalEarning = $search_totalEarning + floatval($price);
                                                                $search_DeliveredOrders =  $search_DeliveredOrders + 1;
                                                            }

                                                            if ($status == "Order Placed") {
                                                                $search_placedOrders = $search_placedOrders + 1;
                                                            }

                                                            if ($status == "Dispatched") {
                                                                $search_dishpatchedOrders = $search_dishpatchedOrders + 1;
                                                            }

                                                            if ($status == "Cancelled") {
                                                                $search_cancelledOrders = $search_cancelledOrders + 1;
                                                            }

                                                            if ($status == "On The Way") {
                                                                $search_onthewayOrders = $search_onthewayOrders + 1;
                                                            }



                                                            echo '  <tr>
                                                            <td>' . $usr_name . '</td>
                                                            <td>' . $title . '</td>
                                                            <td>' . $quantity . '</td>
                                                            <td>&#8377;' . $price . '</td>
                                                            <td>' . $usr_address . '</td>
                                                            <td class="border_left border_bottom">
                                                            <a class="cancel-reason" style="background-color: white;color: #f81212;">
                                                               ' . $cancel_reason . '
                                                            </a>
                                                                <a class="order_status-btn status-box-' . $order_status . '" data-icons=""><img style="" class="img-' . $order_status . '" src="../images/status-' . $order_status . '.png"> ' . $order_status . '</a>
                                                            </td>
                                                            <td>' . $date . '</td>
                                                            <td class="action_data">
                                                                <a class="all_user-action all-user-delete all_user-action-trash" data-order_id="' . $odr_id . '"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                                                <a class="all_user-action all_user-action-edit all-user-edit" data-order_id="' . $odr_id . '"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                                            </td>
                                                        </tr>';
                                                        }
                                                    }
                                                }
                                            } else if ((!empty($_POST['orderStatus'])) && (!empty($_POST['fromDate']) || !empty($_POST['toDate']) || !empty($_POST['fromTime']) || !empty($_POST['toTime']))) {
                                                // echo "somthing is here<br>";


                                                // $newDate = "$search_fromDate $search_fromTime";
                                                // echo var_dump($newDate);

                                                if (!empty($_POST['fromDate'])) {
                                                    $search_fromDate = $_POST['fromDate'];
                                                }
                                                if (!empty($_POST['toDate'])) {
                                                    $search_toDate = $_POST['toDate'];
                                                }
                                                if (!empty($_POST['fromTime'])) {
                                                    $search_fromTime = $_POST['fromTime'] . ":00";
                                                }
                                                if (!empty($_POST['toTime'])) {
                                                    $search_toTime = $_POST['toTime'] . ":59";
                                                }


                                                $search_fromDate = "$search_fromDate $search_fromTime";
                                                $search_toDate = "$search_toDate $search_toTime";

                                                // echo "<br>Selected Status: " . $order_status;
                                                // echo "<br>from date: " . $search_fromDate;
                                                // echo "<br>to date: " . $search_toDate;
                                                // echo "<br>from Time: " . $search_fromTime;
                                                // echo "<br>to Time: " . $search_toTime;

                                                $sql = "SELECT * FROM `users_orders` WHERE `status` = '$order_status' AND `date` > '$search_fromDate' and `date` <= '$search_toDate' ORDER BY `o_id` DESC";
                                                $result = mysqli_query($conn, $sql);
                                                if ($result) {
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $odr_id = $row['o_id'];
                                                            $usr_id = $row['u_id'];
                                                            $title = $row['title'];
                                                            $quantity = $row['quantity'];
                                                            $cancel_reason = $row['can_reason'];
                                                            $price = $row['price'];
                                                            $status = $row['status'];
                                                            $date = $row['date'];
                                                            $search_totalOrders = $search_totalOrders + 1;

                                                            $user_sql = "SELECT * FROM `users` WHERE `u_id` = $usr_id";
                                                            $user_result = mysqli_query($conn, $user_sql);
                                                            if ($user_result) {
                                                                if (mysqli_num_rows($user_result) == 1) {
                                                                    $user_row = mysqli_fetch_assoc($user_result);

                                                                    $usr_name = $user_row['username'];
                                                                    $usr_address = $user_row['address'];
                                                                }
                                                            }

                                                            // counting the totol Earning of the searched Orders
                                                            if ($status == "Delivered") {
                                                                $search_totalEarning = $search_totalEarning + floatval($price);
                                                                $search_DeliveredOrders =  $search_DeliveredOrders + 1;
                                                            }

                                                            if ($status == "Order Placed") {
                                                                $search_placedOrders = $search_placedOrders + 1;
                                                            }

                                                            if ($status == "Dispatched") {
                                                                $search_dishpatchedOrders = $search_dishpatchedOrders + 1;
                                                            }

                                                            if ($status == "Cancelled") {
                                                                $search_cancelledOrders = $search_cancelledOrders + 1;
                                                            }

                                                            if ($status == "On The Way") {
                                                                $search_onthewayOrders = $search_onthewayOrders + 1;
                                                            }



                                                            echo '  <tr>
                                                                        <td>' . $usr_name . '</td>
                                                                        <td>' . $title . '</td>
                                                                        <td>' . $quantity . '</td>
                                                                        <td>&#8377;' . $price . '</td>
                                                                        <td>' . $usr_address . '</td>
                                                                        <td class="border_left border_bottom">
                                                                        <a class="cancel-reason" style="background-color: white;color: #f81212;">
                                                                            ' . $cancel_reason . '
                                                                        </a>
                                                                            <a class="order_status-btn status-box-' . $order_status . '" data-icons=""><img style="" class="img-' . $order_status . '" src="../images/status-' . $order_status . '.png"> ' . $order_status . '</a>
                                                                        </td>
                                                                        <td>' . $date . '</td>
                                                                        <td class="action_data">
                                                                            <a class="all_user-action all-user-delete all_user-action-trash" data-order_id="' . $odr_id . '"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                                                            <a class="all_user-action all_user-action-edit all-user-edit" data-order_id="' . $odr_id . '"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                                                        </td>
                                                                    </tr>';
                                                        }
                                                    }
                                                }
                                            } else if ((empty($_POST['orderStatus'])) && (!empty($_POST['fromDate']) || !empty($_POST['toDate']) || !empty($_POST['fromTime']) || !empty($_POST['toTime']))) {
                                                // echo "<br>the status is empty but there are anothere values";

                                                $search_fromDate = "2024-01-01";
                                                $search_toDate = date("Y-m-d"); //is a string by default
                                                $search_fromTime = "00:00:00";
                                                $search_toTime = "23:59:59";

                                                // $newDate = "$search_fromDate $search_fromTime";
                                                // echo var_dump($newDate);

                                                if (!empty($_POST['fromDate'])) {
                                                    $search_fromDate = $_POST['fromDate'];
                                                }
                                                if (!empty($_POST['toDate'])) {
                                                    $search_toDate = $_POST['toDate'];
                                                }
                                                if (!empty($_POST['fromTime'])) {
                                                    $search_fromTime = $_POST['fromTime'] . ":00";
                                                }
                                                if (!empty($_POST['toTime'])) {
                                                    $search_toTime = $_POST['toTime'] . ":59";
                                                }


                                                $search_fromDate = "$search_fromDate $search_fromTime";
                                                $search_toDate = "$search_toDate $search_toTime";

                                                // echo "<br>", $search_fromDate;
                                                // echo "<br>", $search_toDate;

                                                $sql = "SELECT * FROM `users_orders` WHERE `date` > '$search_fromDate' and `date` <= '$search_toDate' ORDER BY `o_id` DESC";
                                                $result = mysqli_query($conn, $sql);

                                                if ($result) {
                                                    if (mysqli_num_rows($result) > 0) {
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $odr_id = $row['o_id'];
                                                            $usr_id = $row['u_id'];
                                                            $title = $row['title'];
                                                            $quantity = $row['quantity'];
                                                            $cancel_reason = $row['can_reason'];
                                                            $price = $row['price'];
                                                            $status = $row['status'];
                                                            $date = $row['date'];
                                                            $search_totalOrders = $search_totalOrders + 1;

                                                            $user_sql = "SELECT * FROM `users` WHERE `u_id` = $usr_id";
                                                            $user_result = mysqli_query($conn, $user_sql);
                                                            if ($user_result) {
                                                                if (mysqli_num_rows($user_result) == 1) {
                                                                    $user_row = mysqli_fetch_assoc($user_result);

                                                                    $usr_name = $user_row['username'];
                                                                    $usr_address = $user_row['address'];
                                                                }
                                                            }

                                                            // counting the totol Earning of the searched Orders
                                                            if ($status == "Delivered") {
                                                                $search_totalEarning = $search_totalEarning + floatval($price);
                                                                $search_DeliveredOrders =  $search_DeliveredOrders + 1;
                                                            }

                                                            if ($status == "Order Placed") {
                                                                $search_placedOrders = $search_placedOrders + 1;
                                                            }

                                                            if ($status == "Dispatched") {
                                                                $search_dishpatchedOrders = $search_dishpatchedOrders + 1;
                                                            }

                                                            if ($status == "Cancelled") {
                                                                $search_cancelledOrders = $search_cancelledOrders + 1;
                                                            }

                                                            if ($status == "On The Way") {
                                                                $search_onthewayOrders = $search_onthewayOrders + 1;
                                                            }


                                                            echo '  <tr>
                                                                        <td>' . $usr_name . '</td>
                                                                        <td>' . $title . '</td>
                                                                        <td>' . $quantity . '</td>
                                                                        <td>&#8377;' . $price . '</td>
                                                                        <td>' . $usr_address . '</td>
                                                                        <td class="border_left border_bottom">
                                                                        <a class="cancel-reason" style="background-color: white;color: #f81212;">
                                                                            ' . $cancel_reason . '
                                                                        </a>
                                                                            <a class="order_status-btn status-box-' . $status . '" data-icons=""><img style="" class="img-' . $status . '" src="../images/status-' . $status . '.png"> ' . $status . '</a>
                                                                        </td>
                                                                        <td>' . $date . '</td>
                                                                        <td class="action_data">
                                                                            <a class="all_user-action all-user-delete all_user-action-trash" data-order_id="' . $odr_id . '"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                                                            <a class="all_user-action all_user-action-edit all-user-edit" data-order_id="' . $odr_id . '"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                                                        </td>
                                                                    </tr>';
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        ?>


                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </header>

    </div>


    <?php
    // echo $search_fromDate, "<br>";
    // echo $search_toDate, "<br>";

    if ($_SERVER['REQUEST_METHOD'] == "POST") {


        echo '    <div class="searchDetailsModal">
        <div class="searchDetailsModal_container">
            <div class="searchDetailsModal-start">
                <div class="searchDetailsModal-heading">
                    <h2>Order Details</h2>
                </div>
                <form id="modal-form" action="" method="post">

                    <div class="username">
                        <label for="username">Date :</label>
                        <input type="text" name="username" id="username" placeholder="Date to Date" value="' . $search_fromDate . ' TO ' . $search_toDate . '" readonly>
                    </div>

                    <div class="first_name">
                        <label for="f_name">Total Orders :</label>
                        <input type="text" name="fname" id="f_name" placeholder="Total ORders" value="' . $search_totalOrders . '" readonly>
                    </div>

                    <div class="reg-date">
                        <label for="doj">Total Earning :</label>
                        <input type="text" name="doj" id="doj" placeholder="Total Earning" value="&#8377;' . $search_totalEarning . '" readonly>
                    </div>

                    <div class="last_name">
                        <label for="l_name">Placed-Order :</label>
                        <input type="text" name="lname" id="l_name" placeholder="Place Orders" value ="' . $search_placedOrders . '" readonly>
                    </div>

                    <div class="email">
                        <label for="email">Dispatched :</label>
                        <input type="text" name="lname" id="email" placeholder="Dispacted Orders" value="' . $search_dishpatchedOrders . '" readonly>
                    </div>

                    <div class="phone">
                        <label for="phone">On The Way :</label>
                        <input type="text" name="phone" id="phone" placeholder="on the way orders" value="' . $search_onthewayOrders . '" readonly>
                    </div>

                    <div class="address">
                        <label for="Address">Delivered :</label>
                        <input type="text" name="Address" id="Address" placeholder="delivered Orders" value="' . $search_DeliveredOrders . '" readonly>
                    </div>

                    <div class="reg-date">
                        <label for="doj">Cancelled :</label>
                        <input type="text" name="doj" id="doj" placeholder="Cancelled Orders" value="' . $search_cancelledOrders . '" readonly>
                    </div>


                    <div class="searchDetailsModal-buttons" style="display: flex;">
                        <a class="cancle-btn">CLOSE</a>
                    </div>
                </form>
            </div>
        </div>
    </div>';
    }

    ?>


    <!-- modal for confirm the order for delete the order  -->
    <div class="deleteModalStartHere">
        <div class="delete_confirm-modal">
            <div class="delete_confirm-modal_container">
                <div class="delete_modal-row1">
                    <h2>CATEGORY DELETE</h2>
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



    <!-- modal for display the order details to the user -->
    <div class="update_order-modal">
        <div class="modal__container">
            <div class="modal-start">
                <div class="modal-heading">
                    <h2>UPDATE ORDER</h2>
                </div>

                <div class="order_update-table">
                    <table>
                        <tbody>
                            <tr>
                                <td><strong>Username: </strong></td>
                                <td>
                                    <center id="username">ns</center>
                                </td>
                                <td style="width: 35%;">
                                    <center><a class="order-modal-btn update-order-status">Update Order Status</a></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Title: </strong></td>
                                <td>
                                    <center id="title">Yorkshire Lamb Patties</center>
                                </td>
                                <td style="width: 35%;">
                                    <center><a class="order-modal-btn view-user-details">View User Details</a></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Quantity: </strong></td>
                                <td>
                                    <center id="quantity">1</center>
                                </td>
                                <td style="width: 35%;">
                                    <center><a class="order-modal-btn order-modal-close">EXIT</a></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Price: </strong></td>
                                <td>
                                    <center id="price">&#8377;<span>14.00</span></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td>
                                    <center id="address">ow</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date: </strong></td>
                                <td>
                                    <center id="date">2024-03-12 16:09:32</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status: </strong></td>
                                <td>
                                    <center id="status">Dispatch</center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>




    <?php
    include 'include/_footer.php';
    ?>



    <script src="javascript/script.js"></script>
    <script src="javascript/search_orders.js"></script>
    <!-- <script src="javascript/all_order.js"></script> -->


</body>

</html>