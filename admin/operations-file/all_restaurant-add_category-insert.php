<?php

require '../connection/_connection.php';

$input = file_get_contents("php://input");

$decode = json_decode($input, true);

$catName = $decode['cat_inputValue'];


if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $sql = "SELECT * FROM `res_category` WHERE `c_name` LIKE '$catName'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);

    if ($row == 0) {
        // $categoryName = $_POST['category'];
        $sql = "INSERT INTO `res_category` (`c_id`, `c_name`, `date`) VALUES (NULL, '$catName', current_timestamp())";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo json_encode(array(
                "added" => "successfully",
            ));
        }
    } 
}
