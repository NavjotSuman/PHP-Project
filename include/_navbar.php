<nav>
    <div class="container nav__container">
        <a href="index.php">
            <img src="images/logo.png" alt="" id="logo">
        </a>
        <ul class="nav__menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Restaurants</a></li>
            <!-- <li><a href="course.html">Login</a></li>
            <li><a href="registration.php">Register</a></li> -->
            <?php
            if (empty($_SESSION["user_id"])) // if user is not login
            {
                echo '<li class=""><a href="login.php" class="">Login</a> </li>
							  <li class=""><a href="registration.php" class="">Register</a> </li>';
            } else {


                echo  '<li class=""><a href="your_orders.php" class="">My Orders</a> </li>';
                echo  '<li class=""><a href="logout.php" class="">Logout</a> </li>';
            }

            ?>
        </ul>

        <div class="navButton">
            <div id="open-menu-btn"><img src="images/hamburger-icon.png" class="invert-img" style="width: 2.1rem;" alt=""></div>
            <div id="close-menu-btn"><img src="images/cross.png" class="invert-img" style="width: 2.1rem;" alt=""></div>
        </div>
    </div>
</nav>