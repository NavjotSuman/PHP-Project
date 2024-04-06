<!DOCTYPE html>
<html lang="en">
<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

require 'connection/_dbconnect.php';

$uid = $_SESSION['user_id'];
$imageError = false;
$usernameError = false;

$sql = "SELECT * FROM `users` WHERE `u_id` = $uid";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        $row = mysqli_fetch_assoc($result);

        $username = $row['username'];
        $fname = $row['f_name'];
        $lname = $row['l_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $address = $row['address'];
        $image = $row['image'];
    }
}

// on click Update button
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['update'])) {

    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Checking is he username change or not
    $sql = "SELECT * FROM `users` WHERE `u_id` = $uid AND `username` LIKE '$username'";
    $result = mysqli_query($conn, $sql);
    $his_Username = false;
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        $his_Username = true;
    } else {
        $his_Username = false;
    }

    // Checking Username Duplicacy
    $sql = "SELECT * FROM `users` WHERE `username` LIKE '$username'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row == 0 || $his_Username) {
        // if userName Doesn't Exist

        $noImage = $_FILES['image']['error'];
        if ($noImage) {
            // echo "no image <br>", $noImage;


            $sql = "UPDATE `users` SET `username` = '$username', `f_name` = '$fname', `l_name` = '$lname', `email` = '$email', `phone` = '$phone', `address` = '$address' WHERE `users`.`u_id` = $uid";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
            }
        } else {
            // echo "has Image";

            // what type of picture is uploaded by user
            $extensionInfo = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            // echo $extensionInfo;
            $img_name = $uid . "." . $extensionInfo;

            if ($extensionInfo == "png" || $extensionInfo == "jpg" || $extensionInfo == "jpeg") {
                // echo "your image is supported";



                if ($_FILES['image']['size'] <=  1056784) {
                    // 10,56,784    => 1MB
                    // image size must be 1MB

                    move_uploaded_file($_FILES['image']['tmp_name'], "images/user-profile/" . $img_name);

                    $sql = "UPDATE `users` SET `username` = '$username', `f_name` = '$fname', `l_name` = '$lname', `email` = '$email', `phone` = '$phone',`image` = '$img_name' ,`address` = '$address' WHERE `users`.`u_id` = $uid";
                    $result = mysqli_query($conn, $sql);

                    $_SESSION['image'] = $img_name;
                    $_SESSION['fname'] = $fname;
                    $_SESSION['lname'] = $lname;



                    if ($result) {
                        header("location: userProfile.php");
                    }
                } else {
                    $imageError = true;
                    $imageErrorMessage = "*only Image <= 1MB*";

                    $sql = "UPDATE `users` SET `username` = '$username', `f_name` = '$fname', `l_name` = '$lname', `email` = '$email', `phone` = '$phone', `address` = '$address' WHERE `users`.`u_id` = $uid";
                    $result = mysqli_query($conn, $sql);
                    if ($result) {
                        $_SESSION['fname'] = $fname;
                        $_SESSION['lname'] = $lname;
                        // echo $fname, " ", $lname;
                    }
                }
            } else {
                $imageError = true;
                $imageErrorMessage = "*only JPG, JPEG & PNG files are allowed*";

                $sql = "UPDATE `users` SET `username` = '$username', `f_name` = '$fname', `l_name` = '$lname', `email` = '$email', `phone` = '$phone', `address` = '$address' WHERE `users`.`u_id` = $uid";
                $result = mysqli_query($conn, $sql);
                if ($result) {
                    $_SESSION['fname'] = $fname;
                    $_SESSION['lname'] = $lname;
                    echo $fname, " ", $lname;
                }
            }
        }
    } else {
        $usernameError = true;
        $usernameMessage = "*Username Already Exists*";
    }
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
                <a href="userProfile.php" class="user_navbar-selected">Profile</a>
                <a href="changePassword.php">Change Password</a>
                <a href="logout.php" class="user_navbar-logout">Logout</a>
            </div>
        </div>
        <div class="right_side">
            <div class="form">
                <div class="form_heading">
                    <h2>User Profile</h2>
                </div>

                <form action="" method="post" enctype="multipart/form-data">
                    <div class="update_profile">
                        <img src="images/user-profile/<?php echo $image; ?>" alt="" srcset=""><br>
                        <input type="file" name="image" id="image"><br>
                        <?php
                        if ($imageError) {

                            echo '<small style="color: red;">' . $imageErrorMessage . '</small>';
                        }

                        ?>
                    </div>
                    <div class="username">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" value="<?php echo $username; ?>" placeholder="Username" class="input-box" required>
                        <?php
                        if ($usernameError) {
                            echo '<small style="color: red;">' . $usernameMessage . '</small>';
                        }
                        ?>
                    </div>
                    <div class="flname">
                        <div class="fname">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" placeholder="First Name" class="input-box" required>
                        </div>
                        <div class="lname">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" class="input-box" placeholder="Last Name" required>
                        </div>
                    </div>
                    <div class="email-phone">
                        <div class="email">
                            <label for="email">Email Address</label>
                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" placeholder="xyz@example.com" class="input-box" required>
                        </div>
                        <div class="phone">
                            <label for="phone">Phone Number</label>
                            <input type="number" name="phone" id="phone" value="<?php echo $phone; ?>" placeholder="Phone Number" class="input-box" required>
                        </div>
                    </div>
                    <div class="address">
                        <label for="address">Address</label><br>
                        <textarea name="address" id="address" cols="30" rows="6" placeholder="Address" value="" required><?php echo $address; ?></textarea>
                    </div>
                    <div class="button">
                        <div class="update">
                            <button type="submit" class="update update-btn" name="update">UPDATE</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </header>



    <script src="javascript/main_userProfile.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script> -->
</body>

</html>