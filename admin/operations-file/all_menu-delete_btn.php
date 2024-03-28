<?php

require '../connection/_connection.php';

$input  = file_get_contents("php://input");

$decode = json_decode($input, true);

$dishId = $decode['dishId'];

$sql =  "DELETE FROM dishes WHERE `dishes`.`d_id` = $dishId";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array("deleted" => "successfully"));
}
