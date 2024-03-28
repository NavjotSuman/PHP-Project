<?php

require '../connection/_connection.php';

$input = file_get_contents("php://input");

$decode = json_decode($input, true);

$catId = $decode['catId'];
$catInput = $decode['catInput'];


$sql = "UPDATE `res_category` SET `c_name` = '$catInput' WHERE `res_category`.`c_id` = $catId";

$result = mysqli_query($conn, $sql);

if ($result) {
    echo json_encode(array("updated" => "success"));
}
