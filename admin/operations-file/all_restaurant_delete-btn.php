<?php

require '../connection/_connection.php';

// getting the contet from the javascript file
$input = file_get_contents("php://input");

// true is also required for decode the jsin file
$decode = json_decode($input, true);

$deleteId = $decode['delId'];


$sql = "DELETE FROM restaurant WHERE `restaurant`.`rs_id` = $deleteId";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array("deleted" => "success"));
}
