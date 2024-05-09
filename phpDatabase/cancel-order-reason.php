<?php

session_start();

require '../connection/_dbconnect.php';


if (!isset($_SESSION['user_id'])) {
    header("location: ../login.php");
} else {
    $uid = $_SESSION['user_id'];
}


// geting the content from javascript
$input = file_get_contents("php://input");

// decoding the JSON file and true is required
$decode = json_decode($input, true);

$order_id = $decode['odr_id'];
$can_reason = $decode['can_reason'];

$sql = "UPDATE `users_orders` SET `status` = 'Cancelled', `can_reason`='$can_reason' WHERE `users_orders`.`o_id` = $order_id";
$result = mysqli_query($conn, $sql);


if ($result) {
    echo json_encode(array('cancelOrder' => 'success'));
}
