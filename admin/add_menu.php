<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
}
require '../connection/_dbconnect.php';

// operation after click on the ADD Button
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {


    // all the values of the form
    $dishName = $_POST['dishName'];
    $desc = $_POST['desc'];
    $price = $_POST['price'];
    $restaurnt = $_POST['restaurnt'];

    // fetching the restaurant id
    $sql = "SELECT * FROM `restaurant` WHERE `title` LIKE '$restaurnt'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    $resId = 0;
    if ($row == 1) {
        $row = mysqli_fetch_assoc($result);
        $resId = $row['rs_id'];
    }

    // it will br 4 if there is not image in there and 0 if there is an image available there
    $hasImage = ($_FILES["image"]["error"]);
    // checking the image
    if (!($hasImage)) {

        $img_name = $_FILES['image']['name'];

        // echo $dishName, "<br>";
        // echo $desc, "<br>";
        // echo $price, "<br>";
        // echo $restaurnt, "<br>";
        // echo $resId, "<br>";
        // echo $img_name, "<br>";

        move_uploaded_file($_FILES['image']['tmp_name'], "Res_img/dishes/" . $_FILES['image']['name']);

        $sql = "INSERT INTO `dishes` (`d_id`, `rs_id`, `title`, `slogan`, `price`, `img`) VALUES (NULL, '$resId', '$dishName', '$desc', '$price', '$img_name')";

        $result = mysqli_query($conn, $sql);
    }
}



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navjot</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all_users.css">
    <!-- <link rel="stylesheet" href="css/all_user-modal.css"> -->
    <link rel="stylesheet" href="css/all_restaurant.css">

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">

    <style>
        #desc {
            width: 100%;
            resize: none;
            padding: .9rem .8rem;
            font-size: 1rem;
            color: #1d1d1e;
            font-weight: 500;
            margin-top: .5rem;
            border-radius: 4px;
            border: 1px solid #dcdada;
            background-color: white;
        }

        #desc:focus {
            border-color: #a5a1a1;
        }

        .input-box:focus {
            border-color: #a5a1a1;
        }

        .modal-heading {
            padding-bottom: 0;
            margin-bottom: 3rem;
            background-color: #a5a5a5;
            padding-left: 1rem;
            border-radius: 8px;
            border: 1px solid #8d8888;
            box-shadow: 0 6px 8px #2323232e;
        }

        .modal-heading h2 {
            color: white;
            font-weight: 600;
            /* text-align: center; */
        }

        .modal-heading hr {
            border: 0;
        }
    </style>
</head>

<body>
    <?php include 'include/_navbar.php'; ?>



    <!-- dashboard main started here -->
    <div class="dashboard-main">
        <header>
            <?php
            include 'include/_mainAside.php';
            ?>


            <!--  ================================================================================ right side of the dashboard ================================================================================= -->
            <div class="main-right-display">

                <?php include 'include/_marquee_info.php'; ?>


                <div class="update_restaurant-modal">
                    <div class="modal__container">
                        <div class="modal-start">
                            <div class="modal-heading">
                                <h2>ADD MENU</h2>
                                <hr>
                            </div>
                            <!-- action="operations-file/all_restaurant_modal-update.php" -->
                            <form id="modal-form" method="post" enctype="multipart/form-data">

                                <div class="first_row grid-row rows_b-margin">
                                    <div class="res_name">
                                        <label for="dishName">Dish Name</label><br>
                                        <input type="text" class="input-box" name="dishName" id="dishName" placeholder="Dish Name" minlength="3" required>
                                    </div>
                                    <div class="last_row rows_b-margin">
                                        <label for="restaurnt">Select Restaurant</label><br>
                                        <select name="restaurnt" class="input-box custom-box" id="restaurnt" required>
                                            <option value selected disabled>--Select Restaurant--</option>
                                            <!-- fetching the categories using php -->
                                            <?php
                                            $sql = "SELECT * FROM `restaurant`";
                                            $result = mysqli_query($conn, $sql);

                                            $row = mysqli_num_rows($result);
                                            if ($row > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $cat_name = $row['title'];
                                                    echo "<option value='$cat_name'>$cat_name</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="second_row grid-row rows_b-margin">
                                    <div class="o_days">
                                        <label for="price">Price &#8377;</label><br>
                                        <input type="text" class="input-box" name="price" id="price" placeholder="&#8377;" required>
                                    </div>
                                    <div class="image">
                                        <label for="image">Image &nbsp;<small>Selected Image.jpg</small></label><br>
                                        <input type="file" name="image" id="image" class="input-box" required>
                                    </div>
                                </div>

                                <div class="buss_email">
                                    <label for="desc">Description</label><br>
                                    <!-- <input type="text" class="input-box" name="desc" id="desc" placeholder="Description" required> -->
                                    <textarea name="desc" id="desc" cols="" rows="6" placeholder="Description" required></textarea>
                                </div>


                                <div class="modal-buttons" style="display: flex;">
                                    <input type="submit" class="update-btn btn" value="ADD" name="submit" required>
                                    <input type="reset" class="cancle-btn btn" value="CLEAR">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    </div>





    <?php
    include 'include/_footer.php';
    ?>



    <script src="javascript/script.js"></script>
    <!-- <script src="javascript/all_restaurant_edit-update.js"></script> -->


</body>

</html>