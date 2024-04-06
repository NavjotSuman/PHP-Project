<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
} else {
    $image = $_SESSION['image'];
    $fname = $_SESSION['fname'];
    $lname = $_SESSION['lname'];
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - User Profile</title>
    <link rel="stylesheet" href="css/userProfile.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->



</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="border-bottom: 1px solid grey; box-shadow: 0 0 5px #7b6464f5; z-index:20;">
        <a href="userProfile.php" class="navbar-brand" style="margin-left:1.4rem;">
            <h2 style="text-shadow: 0 0 10px #1b1919;">User Profile</h2>
        </a>
    </nav>


    <header>
        <div class="left_side">
            <div class="user_image">
                <a href="userProfile.php"><img src="images/user-profile/<?php echo $image; ?>" alt="" srcset="" class="left_side-picture"></a>
                <span><?php echo $fname, " ", $lname; ?></span>
            </div>
            <div class="user_navbar">
                <a href="userProfile.php">Profile</a>
                <a href="changePassword.php" class="user_navbar-selected">Change Password</a>
                <a href="logout.php" class="user_navbar-logout">Logout</a>
            </div>
        </div>
        <div class="right_side">
            <div class="form">
                <div class="form_heading">
                    <h2>Change Password</h2>
                </div>

                <form action="" method="post">
                    <div class="username">
                        <label for="prepassword">Previous Password</label>
                        <input type="password" name="prepassword" id="prepassword" value="" placeholder="Password" class="input-box" required>
                    </div>
                    <div class="button">
                        <div class="update">
                            <button type="submit" class="update-btn update-btn">SUBMIT</button>
                        </div>
                    </div>
                    <!-- <div class="Newpassword">
                        <div class="npass">
                            <label for="npass">New Password</label>
                            <input type="password" name="npass" id="npass" value="" placeholder="New Password" class="input-box" required>
                        </div>
                        <div class="cpass">
                            <label for="cpass">Confirm Password</label>
                            <input type="text" name="cpass" id="cpass" value="" class="input-box" placeholder="Confirm Password" required>
                        </div>
                    </div> -->
                    <!-- <div class="button">
                        <div class="update">
                            <button type="submit" class="change-password-btn change-password">Change Password</button>
                        </div>
                    </div> -->
                </form>
            </div>
        </div>
    </header>



    <script src="javascript/userProfile.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->
</body>

</html>