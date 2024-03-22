<?php

require '../connection/_connection.php';


// getting the content from the javascript
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);


$oid = $decode['oid'];
$status = $decode['status'];

$sql = "UPDATE `users_orders` SET `status` = '$status' WHERE `users_orders`.`o_id` = $oid";
$result = mysqli_query($conn, $sql);



if ($result) {
    echo json_encode(array('updated' => 'success'));
}
