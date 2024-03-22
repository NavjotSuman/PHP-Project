<!DOCTYPE html>
<html lang="en">
<?php

if (!(($_SERVER['REQUEST_METHOD']) && isset($_GET['newform_id']))) {
?>
    <script>
        setTimeout(() => {
            window.close();
        }, 800);
    </script>
<?php
}

require '../connection/_dbconnect.php';
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="css/userProfile.css">

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    $form_id = $_GET['newform_id'];
    $sql = "SELECT * FROM `users` WHERE `u_id` = $form_id";
    $result = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($result);

    if ($row == 1) {
        $row = mysqli_fetch_assoc($result);

        $date = $row['date'];
        $f_name = $row['f_name'];
        $l_name = $row['l_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $status = $row['status'];

        if ($status == "1") {
            $status = "Active";
        }else {
            $status = "Offline";
        }
    }

    ?>
    <div class="user_details">
        <div class="container">
            <div class="top-div div-padding "><strong><?php echo $f_name?>'s Profile</strong></div>
            <div class="black_div grid-divider t-border">
                <div class="left-pro div-padding"> </div>
                <div class="right-pro div-padding"> </div>
            </div>

            <div class="reg-date grey-bg grid-divider t-border">
                <div class="left-pro div-padding">Reg Date:</div>
                <div class="right-pro div-padding"><?php echo $date; ?></div>
            </div>
            <div class="fname  grid-divider t-border">
                <div class="left-pro div-padding">First Name: </div>
                <div class="right-pro div-padding"><?php echo $f_name; ?></div>
            </div>
            <div class="lname grey-bg grid-divider t-border">
                <div class="left-pro div-padding">Last Name: </div>
                <div class="right-pro div-padding"><?php echo $l_name; ?></div>
            </div>
            <div class="email  grid-divider t-border">
                <div class="left-pro div-padding">User Email: </div>
                <div class="right-pro div-padding"><?php echo $email; ?></div>
            </div>
            <div class="phone grey-bg grid-divider t-border">
                <div class="left-pro div-padding">User Phone: </div>
                <div class="right-pro div-padding"><?php echo $phone; ?></div>
            </div>
            <div class="status  grid-divider t-border">
                <div class="left-pro div-padding">Status: </div>
                <div class="right-pro div-padding"><a><?php echo $status; ?></a></div>
            </div>
            <div class="bottom-div div-padding t-border" style="padding: 1.3rem 1rem;">
                <a class="exit-button__user-modal">close the window</a>
            </div>
        </div>
    </div>


    <script>
        document.querySelector(".exit-button__user-modal").addEventListener('click', () => {
            window.close();
        })
    </script>
</body>

</html>