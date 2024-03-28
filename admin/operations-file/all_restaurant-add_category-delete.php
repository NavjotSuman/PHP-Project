<?php

require '../connection/_connection.php';

$input = file_get_contents("php://input");

$decode = json_decode($input, true);

$catId = $decode['catid'];

$sql = "DELETE FROM res_category WHERE `res_category`.`c_id` = $catId";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array("deleted" => "success"));
}
