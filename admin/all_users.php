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
                                        <li><a><span>All Restaurant</span></a></li>
                                        <li><a><span>Add Category</span></a></li>
                                        <li><a><span>Add Restaurant</span></a></li>
                                    </ul>
                                </li>
                                <li class="flex-aside-li list-bg hidden-off">
                                    <a class="flex-anchor"><img class="aside-img " src="images/icons/utensils-solid.png" alt="" srcset=""><span>Menu</span><img src="images/icons/greater-than-solid.png" class="arraw-img" alt="" srcset=""></a>
                                    <ul hidden class="hidden-div">
                                        <li><a><span>All Menus</span></a></li>
                                        <li><a><span>Add Menus</span></a></li>
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
                <div class="admin__dashboard">
                    <div class="admin__dashboard-container">

                        <div class="dashboard__header">
                            <h4>All Users</h4>
                        </div>


                        <!-- first row in admin dashboard -->

                        <div class="all_users-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>Username</td>
                                        <td>Firstname</td>
                                        <td>Lastname</td>
                                        <td>Email</td>
                                        <td>Phone</td>
                                        <td>Address</td>
                                        <td>Reg-date</td>
                                        <td style="width: 12%;">Action</td>
                                    </tr>
                                </thead>

                                <tbody id="display_users_detail">
                                    <!-- filling it using javascript -->
                                    <!-- <tr>
                                        <td>us</td>
                                        <td>s</td>
                                        <td>kl</td>
                                        <td>ijl</td>
                                        <td>jhk</td>
                                        <td>nkjhli</td>
                                        <td>nbhj</td>
                                        <td class="action_data">
                                            <a class="all_user-action all_user-action-trash"><img src="images/icons/trash-solid.png" alt="" srcset=""></a>
                                            <a class="all_user-action all_user-action-edit"><img src="images/icons/file-pen-solid.png" alt="" srcset=""></a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </header>

    </div>


    <div class="update_user-modal">
        <div class="modal__container">
            <div class="modal-start">
                <div class="modal-heading">
                    <h2>Update User</h2>
                </div>
                <form id="modal-form" action="" method="post">

                    <div class="username">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>

                    <div class="first_name">
                        <label for="f_name">First Name :</label>
                        <input type="text" name="fname" id="f_name" placeholder="First Name">
                    </div>

                    <div class="last_name">
                        <label for="l_name">Last Name :</label>
                        <input type="text" name="lname" id="l_name" placeholder="Last Name">
                    </div>

                    <div class="email">
                        <label for="email">Email :</label>
                        <input type="text" name="lname" id="email" placeholder="Email">
                    </div>

                    <div class="phone">
                        <label for="phone">Phone :</label>
                        <input type="text" name="phone" id="phone" placeholder="Phone Number">
                    </div>

                    <div class="address">
                        <label for="Address">Address :</label>
                        <input type="text" name="Address" id="Address" placeholder="Address">
                    </div>

                    <div class="reg-date">
                        <label for="doj">Reg-Date :</label>
                        <input type="text" name="doj" id="doj" placeholder="Register Date">
                    </div>

                    <div class="modal-buttons" style="display: flex;">
                        <a class="cancle-btn">CLOSE</a>
                        <a class="submit-btn">UPDATE</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <?php
    include 'include/_footer.php';
    ?>



    <script src="javascript/script.js"></script>
    <script src="javascript/all_user.js"></script>
</body>

</html>