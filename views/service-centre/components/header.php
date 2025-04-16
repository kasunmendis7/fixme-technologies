<?php

use app\core\Application;

?>


<!-- Menu and search -->
<div class="main">
    <div class="topbar">
        <div class="toggle">
            <ion-icon name="menu-outline"></ion-icon>
        </div>

        <div class="search">
            <label>
                <input type="text" placeholder="Search here">
                <ion-icon name="search-outline"></ion-icon>
            </label>
        </div>
        <?php
            include_once __DIR__ . '/notification.php';
        ?>
        <div class="user-account">
            <h6 class="user-name">
                <?php
                $username = strtoupper(Application::$app->serviceCenter->{'name'});
                echo $username;
                ?>
            </h6>

            <div class="user">
                <img src="/assets/select-user-service-centre.png" alt="">
            </div>
        </div>
    </div>