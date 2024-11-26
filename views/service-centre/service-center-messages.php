<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Technician Home</title>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="/css/technician/technician-messages.css">
    <link rel="stylesheet" href="/css/technician/overlay.css">

</head>
<body>
    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Mailbox <small>13 new messages</small></h1>
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Mailbox</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <button class="btn primary-btn">Compose</button>
                    <div class="box">
                        <h3 class="box-title">Folders</h3>
                        <ul class="nav">
                            <li class="active"><a href="#">Inbox <span class="label">12</span></a></li>
                            <li><a href="#">Sent</a></li>
                            <li><a href="#">Drafts</a></li>
                            <li><a href="#">Junk <span class="label">65</span></a></li>
                            <li><a href="#">Trash</a></li>
                        </ul>
                    </div>
                    <div class="box">
                        <h3 class="box-title">Labels</h3>
                        <ul class="nav">
                            <li><a href="#">Important</a></li>
                            <li><a href="#">Promotions</a></li>
                            <li><a href="#">Social</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="box primary">
                        <h3 class="box-title">Inbox</h3>
                        <div class="box-tools">
                            <input type="text" class="search" placeholder="Search Mail"/>
                        </div>
                        <div class="mailbox-controls">
                            <button class="btn default-btn">Check All</button>
                            <button class="btn default-btn">Delete</button>
                            <button class="btn default-btn">Reply</button>
                            <button class="btn default-btn">Share</button>
                            <button class="btn default-btn">Refresh</button>
                        </div>
                        <div class="mailbox-messages">
                            <table>
                                <tbody>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><span class="star"></span></td>
                                    <td><a href="#">Kasun Mendis</a></td>
                                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                    <td>5 mins ago</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><span class="star"></span></td>
                                    <td><a href="#">Sheane Mario</a></td>
                                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                    <td>5 mins ago</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><span class="star"></span></td>
                                    <td><a href="#">Pulasthi Abisheke</a></td>
                                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                    <td>5 mins ago</td>
                                </tr>
                                <tr>
                                    <td><input type="checkbox"></td>
                                    <td><span class="star"></span></td>
                                    <td><a href="#">Nimal Rathinarasa</a></td>
                                    <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                                    <td>5 mins ago</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- JavaScript Files -->
    <script src="/js/technician/technician-messages.js"></script>
    <!-- Overlay for the confirmation message -->
    <div id="signOutOverlay" class="overlay">
        <div class="overlay-content">
            <p>Are you sure you want to sign out?</p>
            <button id="confirmSignOut" class="btn"><a href="/technician-logout"></a> Yes</button>
            <button id="cancelSignOut" class="btn">No</button>
        </div>
    </div>
    <script src="/js/technician/overlay.js"></script>

</body>
</html>