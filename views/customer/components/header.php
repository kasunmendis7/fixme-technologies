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