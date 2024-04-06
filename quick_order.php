<?php
session_start();

require 'connection/_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == "GET" && $_GET['dishNum']) {
    $dishNum = $_GET['dishNum'];
    $userId = $_SESSION['user_id'];
    echo $userId;

    $sql = "SELECT * FROM `dishes` WHERE `d_id` = $dishNum";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        $row = mysqli_fetch_assoc($result);

        $dishName = $row['title'];
        $quantity = 1;
        $price = $row['price'];

        $sql = "INSERT INTO `users_orders` (`o_id`, `u_id`, `d_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES (NULL, '$userId', '$dishNum', '$dishName', '$quantity', '$price', 'dispatch', current_timestamp())";

        $result = mysqli_query($conn, $sql);

        if ($result) {

            // increasing the order count value of the dish with the 1
            $odr_count = $row['odr_count'];

            // converting it to int
            $odr_count = intval($odr_count);

            $odr_count = $odr_count + 1;

            $sql = "UPDATE `dishes` SET `odr_count` = '$odr_count' WHERE `dishes`.`d_id` = $dishNum";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("location: your_orders.php");
            }
        }
    }
}
