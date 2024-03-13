<?php


require '../connection/_connection.php';


// getting the content from the javascript
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);

$editId = $decode['uid'];

$sql = "SELECT * FROM `users` WHERE `u_id` = $editId";
$result = mysqli_query($conn, $sql);


$output = [];

$row = mysqli_num_rows($result);

if ($row > 0) {
    $row  = mysqli_fetch_assoc($result);
    $output[] = $row;
} else {
    return false;
}


mysqli_close($conn);
echo json_encode($output);
