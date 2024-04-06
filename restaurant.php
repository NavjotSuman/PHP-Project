<!DOCTYPE html>
<html lang="en">

<?php
require('connection/_dbconnect.php');
session_start();
// $_SESSION['user_id'] = 'true';
// session_unset();
// session_destroy();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.00">
    <link rel="icon" href="images/icon.png" sizes="1400*1400">
    <title>foody - Navjot Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/restaurant.css">
</head>

<body>

    <?php
    // includeing the navbar into the file from the already written file
    require('include/_navbar.php');
    ?>







    <!-- ============================================= RESTAURANT NAVBAR ========================================================== -->
    <div class="page-wrapper">
        <div class="restaurant_step_navbar">
            <div class="container">
                <ul class="row_links">
                    <li><span class="step_counting step_counting-selected">1</span><a href="restaurant.php">Choose Restaurant</a></li>
                    <li><span class="step_counting">2</span><a>Pick your favourite food</a></li>
                    <li><span class="step_counting">3</span><a>Order and Pay</a></li>
                </ul>
            </div>
        </div>

        <section class="top_restaurant">
            <div class="res_details_section">
                <div class="container">
                    <div class="choose_res_heading">
                        <!-- <h1><span>Choose One </span>Restaurant</h1> -->
                    </div>
                </div>
            </div>
        </section>

        <section class="restaurants-page">

            <div class="res_all">
                <div class="container">
                    <div class="res_all__heading">
                        <h1>Choose One Restaurant</h1>
                        <p>Every Restaurant is Best</p>
                    </div>
                </div>
                <div class="res_container">
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM `restaurant`");
                    while ($row = mysqli_fetch_assoc($result)) {
                        // <button onclick = "window.location.href='www.linktothepage.com';"

                        echo '<article>
                            <div class="res_details">
                                <div class="res_img">
                                    <img src="admin/Res_img/' . $row['image'] . '" alt="" srcset="">
                                </div>
                                <div class="res_info">
                                    <h2>' . $row['title'] . '</h2>
                                    <p>' . $row['address'] . '</p>
                                </div>
                            </div>
    
                            <div class="hotel_view-btn">
                                <a href="dishes.php?Res_id=' . $row['rs_id'] . '" class="btn view_menu-btn">View menu</a>
                            </div>
                        </article>';
                    }
                    ?>
                </div>


                <!-- <article>
                        <div class="res_details">
                            <div class="res_img">
                                <img src="admin/Res_img/606d720b5fc71.jpg" alt="" srcset="">
                            </div>
                            <div class="res_info">
                                <h2>Nan Xiang Xiao Long Bao</h2>
                                <p>Queens, New York</p>
                            </div>
                        </div>

                        <div class="hotel_view-btn">
                            <a href="" class="btn view_menu-btn">View menu</a>
                        </div>
                    </article> -->
            </div>
    </div>
    </section>
    </div>







    <?php
    // including the fotte for the website from the already written file
    include('include/_footer.php');
    ?>

    <script src="javascript/script.js"></script>

</body>

</html>