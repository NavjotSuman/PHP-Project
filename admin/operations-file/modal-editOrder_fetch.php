<?php


require '../connection/_connection.php';


// getting the content from the javascript
$input = file_get_contents("php://input");

// true is required for decode the json file
$decode = json_decode($input, true);

$orderId = $decode['oid'];

// fetching the order 
$sql = "SELECT * FROM `users_orders` WHERE `o_id` = $orderId";
$result = mysqli_query($conn, $sql);

$output = [];

// checking the number of rows
$row = mysqli_num_rows($result);


if ($row == 1) {
    $row = mysqli_fetch_assoc($result);

    $date = $row['date'];
    $title = $row['title'];
    $quantity = $row['quantity'];
    $price = $row['price'];
    $status = $row['status'];
    $uid = $row['u_id'];
    $orderId = $row['o_id'];


    $user_sql = "SELECT * FROM `users` WHERE `u_id` = $uid";
    $user_result = mysqli_query($conn, $user_sql);

    $user_row = mysqli_num_rows($user_result);
    if ($user_row == 1) {
        $user_row = mysqli_fetch_assoc($user_result);

        $username = $user_row['username'];
        $address = $user_row['address'];


        // making an array of the all data thatrequired for modal
        $arr = array(
            "username" => "$username",
            "address" => "$address",
            "title" => "$title",
            "quantity" => "$quantity",
            "price" => "$price",
            "status" => "$status",
            "date" => "$date",
            "u_id" => "$uid",
            "o_id" => "$orderId",

        );
        $output[] = $arr;
    }
} else {
    return false;
}


mysqli_close($conn);
echo json_encode($output);
