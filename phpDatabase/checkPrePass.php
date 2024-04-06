<?php

session_start();

require '../connection/_dbconnect.php';

// geting the content from javascript
$input = file_get_contents("php://input");

// decoding the JSON file and true is required
$decode = json_decode($input, true);

$uid = $_SESSION['user_id'];
$prePass = $decode['prePassword'];


$sql = "SELECT * FROM `users` WHERE `u_id` = $uid AND `password` LIKE '$prePass'";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_num_rows($result);

    if ($row == 1) {
        echo json_encode(array("prePassword" => "true"));
    }
}
