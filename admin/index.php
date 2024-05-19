<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require '../connection/_dbconnect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>

<body>
    <div class="login_container">
        <div class="container">
            <div class="login_heading">
                <h1>Admin Panel</h1>
            </div>
            <div class="login_section">
                <div class="thumbnail">
                    <div class="thumbnail_circle">
                        <img src="images/manager.png" alt="" srcset="">
                    </div>
                </div>

                <?php
                try {
                    if ($_SERVER['REQUEST_METHOD'] == "POST") {

                        if (isset($_POST['username']) && isset($_POST['password'])) {

                            $username = $_POST['username'];
                            $password = $_POST['password'];


                            $sql = "SELECT * FROM `admin` WHERE `username` LIKE '$username' AND `password` LIKE '$password'";
                            $result = mysqli_query($conn, $sql);

                            $row = mysqli_num_rows($result);

                            if ($row == 1) {
                                $row = mysqli_fetch_assoc($result);
                                $_SESSION['admin_id'] = $row['adm_id'];
                                $_SESSION["adm_id"] = $row['adm_id'];

                                header("location: dashboard.php");
                            }
                        }
                    }
                } catch (Exception $th) {
                    $a = $th;
                }
                ?>

                <div class="form">
                    <form action="" method="post">
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <button type="submit" class="login-btn">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>