<?php

require '../connection/_connection.php';

// getting the content from the javascript file
$input = file_get_contents("php://input");

// truw is require for decode the json file
$decode = json_decode($input, true);

$resId = $decode['resid'];

$sql = "SELECT * FROM `restaurant` WHERE `rs_id` = $resId";
$result = mysqli_query($conn, $sql);

$output = [];

$row = mysqli_num_rows($result);

if ($row == 1) {
    $row = mysqli_fetch_assoc($result);

    $title = $row['title'];
    $email = $row['email'];
    $phone = $row['phone'];
    $url = $row['url'];
    $ohr = $row['o_hr'];
    $chr = $row['c_hr'];
    $odays = $row['o_days'];
    $address = $row['address'];
    $image = $row['image'];
    $cat_id = $row['c_id'];

    $cat_sql = "SELECT * FROM `res_category` WHERE `c_id` = $cat_id";
    $cat_result = mysqli_query($conn, $cat_sql);

    $cat_row = mysqli_num_rows($cat_result);
    if ($cat_row == 1) {
        $cat_row = mysqli_fetch_assoc($cat_result);
        $category = $cat_row['c_name'];

        $arr = array(
            "title" => "$title",
            "email" => "$email",
            "phone" => "$phone",
            "url" => "$url",
            "ohr" => "$ohr",
            "chr" => "$chr",
            "odays" => "$odays",
            "address" => "$address",
            "image" => "$image",
            "category" => "$category",
        );
        $output[] = $arr;
    }
}


mysqli_close($conn);
echo json_encode($output);


// echo "<pre>";
// echo var_dump($output);
// echo "</pre>";
