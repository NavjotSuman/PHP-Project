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
    <link rel="stylesheet" href="css/style.css"> <?php echo time(); ?>
    <link rel="stylesheet" href="css/login.css">

</head>

<body>
    <!-- HEADER INCLUDING USING PHP -->
    <?php
    include('include/_navbar.php');
    ?>
    
    <div class="form__container">
        <div class="login__form">
            <h3>Login to your Account</h3>
            <form action="">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button>Login</button>
            </form>

            <div class="new_acc">
                <p>Not registered?</p> <a href="registration.php">Create an account</a>
            </div>
        </div>
    </div>




    <!-- FOOTER INCLUDING USING PHP -->
    <?php
    include('include/_footer.php');
    ?>

</body>

</html>