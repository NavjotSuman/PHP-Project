<?php

require '../connection/_connection.php';


$sql = "SELECT * FROM `users_orders`";
$result = mysqli_query($conn, $sql);

$row = mysqli_num_rows($result);
$output = [];

if ($row > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $uid = $row['u_id'];

        $user_sql = "SELECT * FROM `users` WHERE `u_id` = $uid";
        $user_result = mysqli_query($conn, $user_sql);
        $user_row = mysqli_num_rows($user_result);
        if ($user_row > 0) {
            $user_row = mysqli_fetch_assoc($user_result);

            $username = $user_row['username'];
            $address = $user_row['address'];
            $title  = $row['title'];
            $quantity  = $row['quantity'];
            $price  = $row['price'];
            $status  = $row['status'];
            $date  = $row['date'];
            $order_id = $row['o_id'];


            $arr = array(
                "username" => $username,
                "address" => "$address",
                "title" => "$title",
                "quantity" => "$quantity",
                "price" => "$price",
                "status" => "$status",
                "date" => "$date",
                "order_id" => "$order_id",
            );

            $output[] = $arr;
        }
    }
} else {
    return false;
}

// echo "<pre>";
// echo var_dump($output);
// echo "</pre>";

// mysqli_close($conn);
echo json_encode($output);
