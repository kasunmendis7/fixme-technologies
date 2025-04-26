<!-- Menu and search -->
<?php

use app\core\Application;

?>
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>

        <div class="search">
            <!--            <label>-->
            <!--                <input type="text" placeholder="Search here">-->
            <!--                <ion-icon name="search-outline"></ion-icon>-->
            <!--            </label>-->
        </div>
        <div class="user-account">
            <h6 class="user-name">
                <li class="position-relative">
                    <a href="/service-center-view-cart" class="nav-link px-2"
                       style="position: relative; display: inline-block;">
                        <ion-icon name="cart-outline" style="font-size: 24px;  color: white;"></ion-icon>
                        <span id="cart-count" class="position-absolute badge rounded-pill bg-danger" style="
                display: none;
                top: -5px;
                right: -10px;
                font-size: 0.65rem;
                background-color: #dc3545;
                color: white;
                padding: 3px 6px;
                border-radius: 50%;
                box-shadow: 0 0 4px rgba(0, 0, 0, 0.3);
                min-width: 18px;
                text-align: center;
                font-weight: bold;
                position: absolute;
            ">
                            0
                        </span>
                    </a>
                </li>
                <?php
                $username = strtoupper(Application::$app->customer->{'fname'}) . ' ' . strtoupper(Application::$app->customer->{'lname'});
                echo $username;
                ?>
            </h6>
            <div class="user">
                <img src="<?php echo Application::$app->customer->{'profile_picture'} ?>" alt="Profile Pic">
            </div>
        </div>
    </div>