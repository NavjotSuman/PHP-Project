<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "navjot-php-project";

try {
    $conn = mysqli_connect($servername, $username, $password, $databasename);
} catch (Exception $th) {
    echo "there is an excetion error in connection folder.<br>";
    echo mysqli_connect_error();
}
