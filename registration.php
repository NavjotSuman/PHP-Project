<!DOCTYPE html>
<html lang="en">
<?php
require('connection/_dbconnect.php');
session_start();

if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    header("location: index.php");
}

$is_usernameExist = false;
$is_phone_no_wrong = false;
$is_password_wrong = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone_no = $_POST['phone_no'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['delivery_address'];

    // echo var_dump(strlen($phone_no));

    // $username = str_contains($username, ' ');
    // echo $username;


    // checking is the username already existed in the database of the users
    $sql = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $is_usernameExist = true;
    } else {
        // checking the counting of the phone number.
        if (strlen($phone_no) == 10 || ((strlen($phone_no) > 10) && (strlen($phone_no) <= 13))) {
            // checking is the both passwords match each other or not
            if ($password == $cpassword) {
                $sql = "INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`) VALUES (NULL, '$username', '$fname', '$lname', '$email', '$phone_no', '$password', '$address', '1', current_timestamp());";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    header('location:login.php');
                } else {
                    echo mysqli_error($conn);
                }
            } else {
                $is_password_wrong = true;
            }
        } else {
            $is_phone_no_wrong = true;
        }
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/registration.css">

</head>

<body>

    <?php
    include('include/_navbar.php');
    ?>

    <header>
        <div class="container">
            <div class="form_details">

                <div class="form_heading">
                    <h2>NEW ACCOUNT</h2>
                </div>

                <div class="form__container">

                    <form action="registration.php" method="post">
                        <div class="username">
                            <label for="username">User-Name</label><br>
                            <input type="text" name="username" id="username" required class="data-input" minlength="3">
                            <?php
                            if ($is_usernameExist == true) {
                                echo '<small>@username already existed!!</small>';
                            }
                            ?>
                        </div>

                        <div class="name_detail grid-form">
                            <div class="first_name ">
                                <label for="fname">First Name</label><br>
                                <input type="text" name="fname" id="fname" required class="data-input">
                            </div>
                            <div class="last_name ">
                                <label for="lname">Last Name</label><br>
                                <input type="text" name="lname" id="lname" required class="data-input" minlength="3">
                            </div>
                        </div>

                        <div class="email-and-number-details grid-form">
                            <div class="email">
                                <label for="email">Email Address</label><br>
                                <input type="email" name="email" id="email" required class="data-input">
                            </div>
                            <div class="phone_number">
                                <label for="phone_no">Phone Number</label><br>
                                <input type="number" name="phone_no" id="phone_no" required class="data-input">
                                <?php
                                if ($is_phone_no_wrong == true) {
                                    echo '<small>*Wrong Number!!</small>';
                                }
                                ?>
                            </div>
                        </div>


                        <div class="password_details grid-form">
                            <div class="password">
                                <label for="password">Password</label><br>
                                <input type="password" name="password" id="password" required class="data-input" minlength="8">
                                <?php
                                if ($is_password_wrong == true) {
                                    echo '<small>*Password didn\'t match!!</small>';
                                }
                                ?>
                            </div>
                            <div class="confirm_password">
                                <label for="cpassword">Confirm Password</label><br>
                                <input type="password" name="cpassword" id="cpassword" required class="data-input" minlength="8">
                            </div>
                        </div>

                        <div class="address">
                            <label for="delivery_address">Delivery Address</label><br>
                            <textarea rows="4" name="delivery_address" id="delivery_address" required class="data-input"></textarea>
                        </div>
                        <div class="form_register_btn">
                            <button class="btn-register btn">Register Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </header>


    <?php
    include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script>
</body>

</html>