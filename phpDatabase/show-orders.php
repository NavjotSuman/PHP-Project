<?php

session_start();

require '../connection/_dbconnect.php';

if (!isset($_SESSION['user_id'])) {
    header("location: ../login.php");
} else {
    $uid = $_SESSION['user_id'];
}
// ORDER BY column DESC
$sql = "SELECT * FROM `users_orders` WHERE `u_id` = $uid ORDER BY `o_id` DESC";
$result = mysqli_query($conn, $sql);

$output = [];
$row = mysqli_num_rows($result);
if ($row > 0) {
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
