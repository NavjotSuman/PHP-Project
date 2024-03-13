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

        // echo $order_name , "<br>";
        // echo $order_price , "<br>";
        // echo $order_quantity , "<br>";

        $sqlRow = "INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES (NULL, '$uid', '$order_name', '$order_quantity', '$order_price', NULL, current_timestamp())";

        $resultRow = mysqli_query($conn, $sqlRow);
    }

    $sqlDeleteRow = "DELETE FROM `cart-items` WHERE `cart-items`.`u_id` = $uid";
    $resultDeleteRow = mysqli_query($conn, $sqlDeleteRow);



    header("location: ../your_orders.php");
}





mysqli_close($conn);
