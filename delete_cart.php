<?php

session_start();

include 'connection/_dbconnect.php';



// getting the content from the javascript
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);


$uid = $_SESSION['user_id'];
$dishName = $decode['delete_item'];



// query from delete items 
$sql = "DELETE FROM `cart-items` WHERE `cart-items`.`u_id` = $uid AND `cart_name` = '$dishName'";
$result  = mysqli_query($conn, $sql);



if ($result) {
    echo json_encode(array('deleted' => 'success'));
} else {
    echo json_encode(array('deleted' => 'failed'));
}
