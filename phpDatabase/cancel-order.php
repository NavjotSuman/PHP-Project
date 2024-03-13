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

$dishOrderNumber = $decode['Delete_order'];

// $dishOrderNumber = 6;

$sql = "DELETE FROM `users_orders` WHERE `o_id` = $dishOrderNumber AND `u_id` = $uid";
$result = mysqli_query($conn, $sql);


if ($result) {
    echo json_encode(array('deleteOrder' => 'success'));
}
