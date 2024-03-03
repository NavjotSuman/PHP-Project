<?php
session_start();
include 'connection/_dbconnect.php';
$uid = $_SESSION['user_id'];
// selection in the decending order on the based of date_of_cart

$sql = "SELECT * FROM `cart-items` WHERE `u_id` = $uid ORDER BY date_of_cart DESC";

$result = mysqli_query($conn, $sql);
$output = [];

if ($row = mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }
} else {
    return false;
}

// echo "<pre>";
// echo var_dump($output);
// echo "</pre>";

mysqli_close($conn);
echo json_encode($output);
