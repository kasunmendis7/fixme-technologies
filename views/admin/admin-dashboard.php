<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
    </head>
    <body>
    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>
    <!-- JavaScript Files -->
    <script src="/js/admin/main.js"></script>
        <!-- ======================= Cards ================== -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="numbers">16</div>
                    <div class="cardName">Active Service Requests</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cog-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">20</div>
                    <div class="cardName">Total Reviews</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="star-outline"></ion-icon>
                </div>
            </div>

            <div class="card">
                <div>
                    <div class="numbers">Rs. 7,842</div>
                    <div class="cardName">Earning</div>
                </div>

                <div class="iconBx">
                    <ion-icon name="cash-outline"></ion-icon>
                </div>
            </div>
        </div>

                
    <!--    Icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>