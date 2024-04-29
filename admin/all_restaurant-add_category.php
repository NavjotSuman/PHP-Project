<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("location: index.php");
}
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
            <?php
            include 'include/_mainAside.php';
            ?>


            <!--  ================================================================================ right side of the dashboard ================================================================================= -->
            <div class="main-right-display">
                <?php
                include 'include/_marquee_info.php';
                ?>
                <!-- <div class="marqueetag">
                    write the marquee here
                    <marquee behavior="" direction="">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi eos sed aliquid culpa distinctio nostrum sequi a quas. Harum omnis at nobis amet deserunt sapiente totam provident laudantium officiis illum?</marquee>
                </div> -->

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



    <!-- modal for confirm the order for delete the order  -->
    <div class="deleteModalStartHere">
        <div class="delete_confirm-modal">
            <div class="delete_confirm-modal_container">
                <div class="delete_modal-row1">
                    <h2>CATEGORY DELETE</h2>
                </div>
                <div class="delete_modal-row2">
                    <P>Are You Sure??</P>
                </div>
                <div class="delete_modal-row3">
                    <a class="btn confirm-btn">CONFIRM</a>
                    <a class="btn cancel-btn">CANCEL</a>
                </div>
            </div>
        </div>
    </div>





    <div class="modal-update_category">
        <div class="upper-box">
            <div class="add-display-category">
                <div class="add_restaurant-category">
                    <div class="add_restaurant-category-container">
                        <div class="add_restaurant_category-heading">
                            <h2>Update Restaurant Category</h2>
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
                                <input type="reset" value="CLEAR">
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