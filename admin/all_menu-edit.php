<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
}
require 'connection/_connection.php';

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    // echo "hi";
    $dishId = $_GET['form_number'];
    $dishName = $_POST['dishName'];
    $restaurant = $_POST['restaurnt'];
    $price = $_POST['price'];
    $desc = $_POST['desc'];


    // fetching the restaurant id
    $sql = "SELECT * FROM `restaurant` WHERE `title` LIKE '$restaurant'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_num_rows($result);
    if ($row == 1) {
        $row = mysqli_fetch_assoc($result);
        $restaurant = $row['rs_id'];
    }


    // checking is there image select for update or not
    $noImage = $_FILES['image']['error'];

    if ($noImage) {
        // there is no new image

        $sql = "UPDATE `dishes` SET `rs_id` = '$restaurant', `title` = '$dishName', `slogan` = '$desc', `price` = '$price' WHERE `dishes`.`d_id` = $dishId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("location: all_menu.php");
        }
    } else {
        // ther is a new image

        move_uploaded_file($_FILES['image']['tmp_name'], "Res_img/dishes/" . $_FILES['image']['name']);

        $imageName = $_FILES['image']['name'];
        $sql = "UPDATE `dishes` SET `rs_id` = '$restaurant', `title` = '$dishName', `slogan` = '$desc', `price` = '$price' , `img` = '$imageName' WHERE `dishes`.`d_id` = $dishId";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            header("location: all_menu.php");
        }
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

        .rows_b-margin {
            margin-bottom: 1.1rem;
        }
    </style>
</head>

<body>
    <?php include 'include/_navbar.php'; ?>



    <!-- dashboard main started here -->
    <div class="dashboard-main">
        <header>
            <aside>
                <div class="aside__container">
                    <div class="aside__container-top">
                        <ul class="aside-dashboard">
                            <h4>HOME</h4>
                            <li class="flex-aside-li"><a href="dashboard.php"><img class="aside-img" src="images/icons/gauge-high-solid.png" alt="" srcset=""><span>Dashboard</span></a></li>
                        </ul>
                    </div>


                    <div class="aside__container-bottom">
                        <div class="admin-controler-links">
                            <ul class="aside-admin">
                                <h4>LOG</h4>
                                <li class="flex-aside-li list-bg"><a href="all_users.php" class="flex-anchor"><img class="aside-img" src="images/icons/user-solid.png" alt="" srcset=""><span>Users</span></a></li>
                                <li class="flex-aside-li list-bg hidden-off">
                                    <a class="flex-anchor"><img class="aside-img" src="images/icons/box-archive-solid.png" alt="" srcset=""><span>Restaurant</span><img src="images/icons/greater-than-solid.png" class="arraw-img" alt="" srcset="">
                                    </a>
                                    <ul hidden class="hidden-div">
                                        <li><a href="all_restaurant.php"><span>All Restaurant</span></a></li>
                                        <li><a href="all_restaurant-add_category.php"><span>Add Category</span></a></li>
                                        <li><a href="add_restaurant.php"><span>Add Restaurant</span></a></li>
                                    </ul>
                                </li>
                                <li class="flex-aside-li list-bg hidden-off">
                                    <a class="flex-anchor"><img class="aside-img " src="images/icons/utensils-solid.png" alt="" srcset=""><span>Menu</span><img src="images/icons/greater-than-solid.png" class="arraw-img" alt="" srcset=""></a>
                                    <ul hidden class="hidden-div">
                                        <li><a href="all_menu.php"><span>All Menus</span></a></li>
                                        <li><a href="add_menu.php"><span>Add Menus</span></a></li>
                                    </ul>
                                </li>
                                <li class="flex-aside-li list-bg"><a href="all_orders.php" class="flex-anchor"><img class="aside-img" src="images/icons/cart-shopping-solid.png" alt="" srcset=""><span>Orders</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </aside>


            <!--  ================================================================================ right side of the dashboard ================================================================================= -->
            <div class="main-right-display">

                <div class="marqueetag">
                    <!-- write the marquee here -->
                    <marquee behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eos sed aliquid culpa distinctio nostrum sequi a quas. Harum omnis at nobis amet deserunt sapiente totam provident laudantium officiis illum?</marquee>
                </div>

                <div class="update_restaurant-modal">
                    <div class="modal__container">
                        <div class="modal-start">
                            <div class="modal-heading">
                                <h2>UPDATE MENU</h2>
                                <hr>
                            </div>
                            <?php
                            if (isset($_GET['form_number'])) {
                                $dishId = $_GET['form_number'];

                                $sql = "SELECT * FROM `dishes` WHERE `d_id` = $dishId";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_num_rows($result);

                                if ($row == 1) {
                                    $row = mysqli_fetch_assoc($result);
                                    $dishName = $row['title'];
                                    $desc = $row['slogan'];
                                    $price = $row['price'];
                                    $image = $row['img'];
                                    $resId = $row['rs_id'];
                                    $resName = "";

                                    $sql = "SELECT * FROM `restaurant` WHERE `rs_id` = $resId";
                                    $result = mysqli_query($conn, $sql);
                                    $row = mysqli_num_rows($result);
                                    if ($row == 1) {
                                        $row = mysqli_fetch_assoc($result);
                                        $resName = $row['title'];
                                    }
                                }
                            }
                            ?>
                            <!-- action="operations-file/all_restaurant_modal-update.php" -->
                            <form id="modal-form" method="post" enctype="multipart/form-data">

                                <div class="first_row grid-row rows_b-margin">
                                    <div class="res_name">
                                        <label for="dishName">Dish Name</label><br>
                                        <input type="text" class="input-box pre-value" name="dishName" id="dishName" data-previous_value="<?php echo $dishName; ?>" placeholder="Dish Name" minlength="3" required>
                                    </div>
                                    <div class="last_row rows_b-margin">
                                        <label for="restaurnt">Select Restaurant</label><br>
                                        <select name="restaurnt" class="input-box custom-box pre-value" id="restaurnt" data-previous_value="<?php echo $resName; ?>" required>
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
                                        <input type="text" class="input-box pre-value" name="price" id="price" data-previous_value="<?php echo $price; ?>" placeholder="&#8377;" required>
                                    </div>
                                    <div class="image rows_b-margin">
                                        <label for="image">Image &nbsp;<small><?php echo $image; ?></small></label><br>
                                        <input type="file" name="image" id="image" data-previous_value="<?php echo $image; ?>" class="input-box">
                                    </div>
                                </div>

                                <div class="buss_email">
                                    <label for="desc">Description</label><br>
                                    <textarea class="input-box pre-value" name="desc" id="desc" cols="" rows="6" data-previous_value="<?php echo $desc; ?>" placeholder="Description" required></textarea>
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
    <script src="javascript/all_menu_edit.js"></script>


</body>

</html>