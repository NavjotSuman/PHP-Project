<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require('connection/_dbconnect.php');

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("location: index.php");
}

$incorrect_username = false;
$incorrect_password = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row ==  1) {
        $row = mysqli_fetch_assoc($result);
        $cpassword = $row['password'];

        if ($cpassword == $password) {
            // make a session and start it for all pages
            // it will indicate that you are a genune user logined

            $_SESSION['user_id'] = $row['u_id'];
            $_SESSION['fname'] = $row['f_name'];
            $_SESSION['lname'] = $row['l_name'];
            $_SESSION['image'] = $row['image'];
            header("location: index.php");
        } else {
            $incorrect_password = true;
        }
    } else {
        $incorrect_username = true;
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <!-- HEADER INCLUDING USING PHP -->
    <?php
    include('include/_navbar.php');
    ?>

    <header>
        <div class="container login__container">
            <div class="form_details">

                <div class="form_heading">
                    <h2>Login To Your Account</h2>
                </div>

                <div class="form__container">

                    <form action="login.php" method="post">
                        <div class="username">
                            <input type="text" name="username" id="username" placeholder="Username" required class="data-input" minlength="3">
                            <?php
                            if ($incorrect_username == true) {
                                echo '<small>*Username incorrect*</small>';
                            }
                            ?>
                        </div>

                        <div class="password">
                            <input type="password" name="password" id="password" placeholder="Password" required class="data-input" minlength="8">
                            <?php
                            if ($incorrect_password == true) {
                                echo '<small>*Password incorrect*</small>';
                            }
                            ?>
                        </div>

                        <div class="btn-login_form">
                            <button class="btn-login btn">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>


    <!-- FOOTER INCLUDING USING PHP -->
    <?php
    include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script>

</body>

</html>