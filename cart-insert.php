<?php
session_start();



include 'connection/_dbconnect.php';

// get the content from javscript file
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);

// echo var_dump($decode);

// $uid = $decode['uid'];
$uid = $_SESSION['user_id'];
$dishName = $decode['dishName'];
$dishValue = $decode['dishValue'];
$dishQuantity = $decode['dishQuantity'];
$dishId = $decode['dishId'];

$sql = "SELECT * FROM `cart-items` WHERE `u_id` = $uid AND `cart_name` LIKE '$dishName'";
$result = mysqli_query($conn, $sql);

$row = mysqli_num_rows($result);
// if cart Already Existed
if ($row > 0) {

    $row = mysqli_fetch_assoc($result);

    // $dishValue = number_format($dishValue1, 2) + number_format($dishValue, 2);

    $dishQuantity_row = $row['cart_quantity'];
    $dishQuantity_row = (int) $dishQuantity_row;
    $dishQuantity = (int) $dishQuantity;
    $dishQuantity_row += $dishQuantity;
    // $dishQuantity = number_format($dishQuantity1, 2) + number_format($dishQuantity1, 2);


    $dishValue_row = $row['cart_price'];
    $dishValue_row = (float) $dishValue_row;
    $dishValue = (float) $dishValue;
    $dishValue_row = $dishValue * $dishQuantity_row;

    // echo var_dump($dishValue);

    $sql = "UPDATE `cart-items` SET `cart_price` = '$dishValue_row', `cart_quantity` = '$dishQuantity_row' WHERE `u_id` = $uid AND `cart_name` LIKE '$dishName'";
    mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(array('insert' => 'success'));
    } else {
        echo json_encode(array('fail' => 'failed'));
    }
} else {
    $sql = "INSERT INTO `cart-items` (`cart_id`, `u_id`,`d_id`, `cart_name`, `cart_price`, `cart_quantity`, `date_of_cart`) VALUES (NULL, '$uid', '$dishId' ,'$dishName', '$dishValue', '$dishQuantity', current_timestamp())";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo json_encode(array('insert' => 'success'));
    } else {
        echo json_encode(array('fail' => 'failed'));
    }
}
