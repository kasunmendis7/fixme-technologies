<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FIXME Dashboard</title>
    <link rel="stylesheet" href="/css/service-center/service-centre-dashboard.css">
    <script src="/js/service-center/service-centre-dashboard.js"></script>
</head>
<body>
<div class="container">
    <aside class="sidebar">
        <div class="logo">FIXME</div>
        <nav>
            <ul>
                <li><a href="#" class="active">Dashboard</a></li>
                <li><a href="#">Map</a></li>
                <li><a href="#">Settings</a></li>
            </ul>
            <hr class="hrtag"/>
        </nav>
        <div class="logout">
            <button>Logout</button>
        </div>
    </aside>
    <main class="main-content">
        <header class="top-bar">
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="search-bar">
                <input type="text" placeholder="Search">
            </div>
            <div class="user-info">
                <span class="notifications"><img src="/assets/notification-bell.png"></span>
<!--                <span class="language">English</span>-->
                <img src="/assets/user_avatar.png" alt="User Avatar" class="avatar">
                <span class="user-name">Moni Roy</span>
            </div>
        </header>
        <div class="dashboard-content">
            <div class="widget-grid">
                <!-- Widget content will go here -->
            </div>
        </div>
    </main>
</div>
</body>
</html>
