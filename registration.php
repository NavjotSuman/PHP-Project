<!DOCTYPE html>
<html lang="en">
<?php
require('connection/_dbconnect.php');
session_start();

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
            <div class="form_heading">
                <h2>NEW ACCOUT FORM</h2>
            </div>

            <div class="form__container">

                <form action="">
                    <div class="username">
                        <label for="username">Username</label><br>
                        <input type="text" name="username" id="username" required class="data-input" maxlength="6">
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
                        </div>
                    </div>


                    <div class="password_details grid-form">
                        <div class="password">
                            <label for="password">Password</label><br>
                            <input type="password" name="password" id="password" required class="data-input">
                        </div>
                        <div class="confirm_password">
                            <label for="cpassword">Confirm Password</label><br>
                            <input type="password" name="cpassword" id="cpassword" required class="data-input">
                        </div>
                    </div>

                    <div class="address">
                        <label for="delivery_address">Delivery Address</label><br>
                        <textarea rows="4" name="delivery_address" id="delivery_address" required class="data-input"></textarea>
                    </div>

                    <button class="btn-register">Register Now</button>
                </form>
            </div>



        </div>
    </header>


    <?php
include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script> 
</body>

</html>