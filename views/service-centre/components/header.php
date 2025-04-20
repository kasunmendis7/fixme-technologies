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
        </div>

        <div class="user-account">
            <h6 class="user-name">
                <?php
                $username = strtoupper(Application::$app->serviceCenter->{'name'});
                echo $username;
                ?>
            </h6>

            <?php
            include_once __DIR__ . '/notification.php';
            ?>
        </div>
    </div>