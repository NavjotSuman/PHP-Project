<?php

require '../connection/_dbconnect.php';

session_start();
if (!(isset($_SESSION['user_id']))) {
    header("location: ../restaurant.php");
}


$uid = $_SESSION['user_id'];

$sql = "SELECT * FROM `cart-items` WHERE `u_id` = $uid";
$result = mysqli_query($conn, $sql);

$row = mysqli_num_rows($result);

if ($row > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $order_name = $row['cart_name'];
        $order_price = $row['cart_price'];
        $order_quantity = $row['cart_quantity'];
        $dishId = $row['d_id'];
        // echo $order_name , "<br>";
        // echo $order_price , "<br>";
        // echo $order_quantity , "<br>";

        $sqlRow = "INSERT INTO `users_orders` (`o_id`, `u_id`,`d_id` ,`title`, `quantity`, `price`, `status`, `date`) VALUES (NULL, '$uid','$dishId' ,'$order_name', '$order_quantity', '$order_price', 'Order Placed', current_timestamp())";

        $resultRow = mysqli_query($conn, $sqlRow);

        /**updaing te order count in the dishes */
        // converting the string to int
        $strQuantity = $order_quantity;
        $my_quantity = intval($strQuantity);

        // fetchong the dish 
        $updateDish_sql = "SELECT * FROM `dishes` WHERE `d_id` = $dishId";
        $updateDish_result = mysqli_query($conn, $updateDish_sql);
        $updateDish_row = mysqli_num_rows($updateDish_result);

        if ($updateDish_row == 1) {
            $updateDish_row = mysqli_fetch_assoc($updateDish_result);
            $odr_count = $updateDish_row['odr_count'];
            // converting it to int
            $odr_count = intval($odr_count);

            $odr_count = $odr_count + $my_quantity;

            $updateDish_sql = "UPDATE `dishes` SET `odr_count` = '$odr_count' WHERE `dishes`.`d_id` = $dishId";
            $updateDish_result = mysqli_query($conn, $updateDish_sql);
        }
    }

    $sqlDeleteRow = "DELETE FROM `cart-items` WHERE `cart-items`.`u_id` = $uid";
    $resultDeleteRow = mysqli_query($conn, $sqlDeleteRow);
}





mysqli_close($conn);

header("location: ../your_orders.php");
