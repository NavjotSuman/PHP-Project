<?php


require '../connection/_connection.php';


// getting the content from the javascript
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);

$deleteId = $decode['uid'];

$sql = "DELETE FROM users_orders WHERE `users_orders`.`o_id` = $deleteId";
$result = mysqli_query($conn, $sql);


if ($result) {
    echo json_encode(array('deleted' => 'success'));
}
