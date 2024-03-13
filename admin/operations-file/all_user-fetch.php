<?php

require '../connection/_connection.php';


$sql = "SELECT * FROM `users`";
$result = mysqli_query($conn, $sql);

$row = mysqli_num_rows($result);
$output = [];

if ($row > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output[] = $row;
    }
} else {
    return false;
}

mysqli_close($conn);
echo json_encode($output);
