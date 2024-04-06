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

    <!-- Required meta tags -->
    <!-- <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> -->

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->

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
                    <li><span class="step_counting step_counting-selected">1</span><a href="restaurant.php">Choose Restaurant</a></li>
                    <li><span class="step_counting step_counting-selected">2</span><a href="dishes.php?Res_id=1">Pick your favourite food</a></li>
                    <li><span class="step_counting step_counting-selected">3</span><a>Order and Pay</a></li>
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



        <!-- modal for confirm the order for delete the order  -->
        <div class="deleteModalStartHere">
            <div class="delete_confirm-modal">
                <div class="delete_confirm-modal_container">
                    <div class="delete_modal-row1">
                        <h2>ORDER DELETE</h2>
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



        <!-- displaying the user orders in the this section  -->
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

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->

</body>

</html>