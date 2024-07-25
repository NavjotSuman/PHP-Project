<?php
if (isset($_SESSION['image'])) {
    $image = $_SESSION['image'];
}
?>
<nav>
    <div class="container nav__container">
        <a href="index.php">
            <img src="images/logo.png" alt="" id="logo">
        </a>
        <ul class="nav__menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="restaurant.php">Restaurants</a></li>
            
            <!-- <li><a href="course.html">Login</a></li>
            <li><a href="registration.php">Register</a></li> -->
            <?php
            if (empty($_SESSION["user_id"])) // if user is not login
            {
                echo '
                <li ><a href="https://github.com/NavjotSuman" target="_blank">Github</a> </li>
                <li class=""><a href="login.php" class="">Login</a> </li>
				<li class=""><a href="registration.php" class="">Register</a> </li>';
            } else {
                echo  '<li class=""><a href="your_orders.php" class="">My Orders</a> </li>
                <li ><a href="https://github.com/NavjotSuman" target="_blank">Github</a> </li>
                ';
                echo  '<li class="Mobile-tablet-li_only"><a href="userProfile.php" class="">User Profile</a> </li>
                <li class="Mobile-tablet-li_only"><a href="logout.php" class="">Logout</a> </li>';
                echo  '<li class="list-user-profile desktop-li_only"><a><img src="images/user-profile/' . $image . '" alt="" class="user-prifile-picture" srcset=""></a></li>';
            }

            ?>
            <!-- <li class="Mobile-tablet-li_only"><a href="userProfile.php" class="">User Profile</a> </li>
            <li class="Mobile-tablet-li_only"><a href="logout.php" class="">Logout</a> </li> -->
            <!-- <li><a href=""><img src="./images/github.png" alt="" style="filter: invert(1);     margin-left: -25px;" width="40px" srcset=""></a></li> -->

        </ul>
        <div class="profile-action">
            <a href="userProfile.php">User Account</a>
            <a href="logout.php" class="update logout-section">Logout</a>
        </div>
        <div class="navButton">
            <div id="open-menu-btn"><img src="images/hamburger-icon.png" class="invert-img" style="width: 2.1rem;" alt=""></div>
            <div id="close-menu-btn"><img src="images/cross.png" class="invert-img" style="width: 2.1rem;" alt=""></div>
        </div>
    </div>
</nav>