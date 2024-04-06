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
    <link rel="stylesheet" href="css/all_order.css">

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
                                <li class="flex-aside-li list-bg"><a class="flex-anchor"><img class="aside-img" src="images/icons/cart-shopping-solid.png" alt="" srcset=""><span>Orders</span></a></li>
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





                        <!-- first row in admin dashboard -->

                        <div class="all_users-table">
                            <table>
                                <thead>
                                    <tr>
                                        <td>User</td>
                                        <td>Title</td>
                                        <td>Quantity</td>
                                        <td>Price</td>
                                        <td>Address</td>
                                        <td>Status</td>
                                        <td>Order Date</td>
                                        <td style="width: 12%;">Action</td>
                                    </tr>
                                </thead>

                                <tbody id="display_orders_detail">
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


    <!-- modal for display the order details to the user -->
    <div class="update_order-modal">
        <div class="modal__container">
            <div class="modal-start">
                <div class="modal-heading">
                    <h2>UPDATE ORDER</h2>
                </div>

                <div class="order_update-table">
                    <table>
                        <tbody>
                            <tr>
                                <td><strong>Username: </strong></td>
                                <td>
                                    <center id="username">ns</center>
                                </td>
                                <td style="width: 35%;">
                                    <center><a class="order-modal-btn update-order-status">Update Order Status</a></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Title: </strong></td>
                                <td>
                                    <center id="title">Yorkshire Lamb Patties</center>
                                </td>
                                <td style="width: 35%;">
                                    <center><a class="order-modal-btn view-user-details">View User Details</a></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Quantity: </strong></td>
                                <td>
                                    <center id="quantity">1</center>
                                </td>
                                <td style="width: 35%;">
                                    <center><a class="order-modal-btn order-modal-close">EXIT</a></center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Price: </strong></td>
                                <td>
                                    <center id="price">$14.00</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Address</strong></td>
                                <td>
                                    <center id="address">ow</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Date: </strong></td>
                                <td>
                                    <center id="date">2024-03-12 16:09:32</center>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Status: </strong></td>
                                <td>
                                    <center id="status">Dispatch</center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>


    <?php
    include 'include/_footer.php';
    ?>



    <script src="javascript/script.js"></script>
    <script src="javascript/all_order.js"></script>
</body>

</html>