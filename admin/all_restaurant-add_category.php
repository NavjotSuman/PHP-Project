<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require '../connection/_dbconnect.php';

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navjot</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/all_users.css">
    <link rel="stylesheet" href="css/all_restaurant-add_category.css">
    <!-- <link rel="stylesheet" href="css/all_user-modal.css"> -->
    <!-- <link rel="stylesheet" href="css/all_restaurant.css"> -->

    <!-- open sans font-family -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
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

                <div class="right_side_boxes">

                    <div class="upper-box">
                        <div class="add-display-category">
                            <div class="add_restaurant-category">
                                <div class="add_restaurant-category-container">
                                    <div class="add_restaurant_category-heading">
                                        <h2>Add Restaurant Category</h2>
                                    </div>
                                    <hr>
                                </div>
                                <form action="" method="post" id="form">
                                    <div class="category">
                                        <label for="category">Category</label><br>
                                        <input type="text" name="category" id="category" minlength="3">
                                        <small style="color: red; font-weight:500;" hidden>Restaurant Already Existed</small>

                                    </div>

                                    <div class="add_restaurant-category_buttons">
                                        <div class="add_button">
                                            <input type="submit" value="ADD" name="add">
                                        </div>
                                        <div class="reset_button">
                                            <input type="reset" value="CANCLE">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="lower-box">
                        <div class="show-category_box">
                            <div class="show_category-container">
                                <div class="show_category_heading">
                                    <h2>Listed Category</h2>
                                </div>
                                <table id="show_category_table">
                                    <thead>
                                        <tr>
                                            <td class="border-right border-bottom">ID</td>
                                            <td class="border-right border-bottom">Category Name</td>
                                            <td class="border-right border-bottom">Date</td>
                                            <td class="border-bottom" style="width: 13%;">Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM `res_category`";
                                        $result = mysqli_query($conn, $sql);
                                        $row = mysqli_num_rows($result);

                                        if ($row > 0) {
                                            $count = 0;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $count += 1;
                                                $cat_id = $row['c_id'];
                                                $cat_name = $row['c_name'];
                                                $cat_date = $row['date'];

                                                echo '<tr>
                                                        <td class="border-right border-top">' . $count . '</td>
                                                        <td class="border-right border-top">' . $cat_name . '</td>
                                                        <td class="border-right border-top">' . $cat_date . '</td>
                                                        <td class="action_data border-top">
                                                        <a class="action-trush_button" data-cat_number="' . $cat_id . '"><img src="images/icons/trash-solid.png" alt="" srcset="" class="action-img"></a>
                                                        <a class="action-edit_button" data-cat_number="' . $cat_id . '"><img src="images/icons/file-pen-solid.png" alt="" srcset="" class="action-img"></a>
                                                        </td>
                                                    </tr>';
                                            }
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    </div>


    <div class="modal-update_category">
        <div class="upper-box">
            <div class="add-display-category">
                <div class="add_restaurant-category">
                    <div class="add_restaurant-category-container">
                        <div class="add_restaurant_category-heading">
                            <h2>Add Restaurant Category</h2>
                        </div>
                        <hr>
                    </div>
                    <form action="" method="post" id="modal_form">
                        <div class="category">
                            <label for="category">Category</label><br>
                            <input type="text" name="category" id="update_category" minlength="3">
                            <small style="color: red; font-weight:500;" hidden>Restaurant Already Existed</small>

                        </div>

                        <div class="add_restaurant-category_buttons">
                            <div class="update_button">
                                <input type="submit" value="UPDATE" name="update">
                            </div>
                            <div class="reset_button">
                                <input type="reset" value="CANCLE">
                            </div>
                            <div class="modal-close">
                                <a>CLOSE</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php
    include 'include/_footer.php';
    ?>



    <script src="javascript/script.js"></script>
    <script src="javascript/all_restaurant-add_category.js"></script>


</body>

</html>