<?php

session_start();

require '../connection/_dbconnect.php';

// geting the content from javascript
$input = file_get_contents("php://input");

// decoding the JSON file and true is required
$decode = json_decode($input, true);


$uid = $_SESSION['user_id'];
$nPass = $decode['nPass'];
$cPass = $decode['cPass'];

if ($nPass == $cPass) {
    $sql = "UPDATE `users` SET `password` = '$cPass' WHERE `users`.`u_id` = $uid";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo json_encode(array("updated" => "success"));
    }
}
