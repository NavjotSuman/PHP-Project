<?php

require '../connection/_connection.php';

$sql = "SELECT * FROM `restaurant`";
$result = mysqli_query($conn, $sql);


$row = mysqli_num_rows($result);

if ($row > 0) {
    $res_cat = array();
    $output = [];
    while ($row = mysqli_fetch_assoc($result)) {


        $category = $row['c_id'];
        $name = $row['title'];
        $email = $row['email'];
        $phone = $row['phone'];
        $url = $row['url'];
        $openHrs = $row['o_hr'];
        $closeHrs = $row['c_hr'];
        $openDays = $row['o_days'];
        $address = $row['address'];
        $image = $row['image'];
        $date = $row['date'];
        $rs_id = $row['rs_id'];


        // array_key_exists is used for check whether a value is exist in the associative array or not.
        if (array_key_exists("$category", $res_cat)) {
            $category = $res_cat["$category"];
        } else {
            $category_sql = "SELECT * FROM `res_category` WHERE `c_id` = $category";
            $category_result = mysqli_query($conn, $category_sql);

            $category_row = mysqli_num_rows($category_result);
            if ($category_row == 1) {
                $category_row = mysqli_fetch_assoc($category_result);

                // add this value to array for further use from it
                $res_cat["$category"] = $category_row['c_name'];
                $category = $res_cat["$category"];

                // echo $category . "<br>";
            }
        }

        $arr = array(
            "category" => "$category",
            "name" => "$name",
            "email" => "$email",
            "phone" => "$phone",
            "url" => "$url",
            "openHrs" => "$openHrs",
            "closeHrs" => "$closeHrs",
            "openDays" => "$openDays",
            "address" => "$address",
            "image" => "$image",
            "date" => "$date",
            "rs_id" => "$rs_id",
        );

        $output[] = $arr;
    }

    echo json_encode($output);
}
