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
    <link rel="stylesheet" href="css/all_user-modal.css">

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