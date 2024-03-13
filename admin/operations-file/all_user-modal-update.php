<?php


require '../connection/_connection.php';


// getting the content from the javascript
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);

$uid = $decode['uid'];
$username = $decode['username'];
$firstName = $decode['firstName'];
$lastName = $decode['lastName'];
$email = $decode['email'];
$phone = $decode['phone'];
$address = $decode['address'];
$doj = $decode['doj'];


$sql = "UPDATE `users` SET `username` = '$username', `f_name` = '$firstName', `l_name` = '$lastName', `email` = '$email', `phone` = '$phone', `address` = '$address', `date` = '$doj' WHERE `users`.`u_id` = $uid";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array('updated' => 'success'));
}
