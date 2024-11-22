<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Service Center Dashboard</title>
    <link rel="stylesheet" href="/css/technician/technician-dashboard.css">
    <link rel="stylesheet" href="/css/customer/overlay.css">
</head>
<body>
<?php
include_once 'components/sidebar.php';
include_once 'components/header.php';
?>
<!-- JavaScript Files -->
<script src="/js/technician/technician-home.js"></script>
<!-- ======================= Cards ================== -->
<div class="cardBox">
    <div class="card">
        <div>
            <div class="numbers">65</div>
            <div class="cardName">Total Repairs</div>
        </div>

        <div class="iconBx">
            <ion-icon name="cog-outline"></ion-icon>
        </div>
    </div>

    <div class="card">
        <div>
            <div class="numbers">2</div>
            <div class="cardName">Level</div>
        </div>

        <div class="iconBx">
            <ion-icon name="trophy-outline"></ion-icon>

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

<!-- ================ Order Details List ================= -->
<div class="details">
    <div class="recentOrders">
        <div class="cardHeader">
            <h2>Recent Orders</h2>
            <a href="#" class="btn">View All</a>
        </div>

        <table>
            <thead>
            <tr>
                <td>Name</td>
                <td>Price</td>
                <td>Payment</td>
                <td>Status</td>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td>Kasun Mendis</td>
                <td>Rs. 620</td>
                <td>Due</td>
                <td><span class="status inProgress">In Progress</span></td>
            </tr>
            <tr>
                <td>Sheane Mario</td>
                <td>Rs. 1200</td>
                <td>Paid</td>
                <td><span class="status delivered">Completed</span></td>
            </tr>

            <tr>
                <td>Pulasthi Abhisheke</td>
                <td>Rs. 110</td>
                <td>Due</td>
                <td><span class="status pending">Pending</span></td>
            </tr>

            <tr>
                <td>Nimal Rathinarasa</td>
                <td>Rs. 1200</td>
                <td>-</td>
                <td><span class="status return">Cancelled</span></td>
            </tr>

            <tr>
                <td>Jimmy Donaldson</td>
                <td>Rs. 620</td>
                <td>Due</td>
                <td><span class="status inProgress">In Progress</span></td>
            </tr>

            <tr>
                <td>Erick Dodger</td>
                <td>Rs. 1200</td>
                <td>Paid</td>
                <td><span class="status delivered">Completed</span></td>
            </tr>

            <tr>
                <td>Steven Schaphiro Laptop</td>
                <td>Rs. 110</td>
                <td>Due</td>
                <td><span class="status delivered">Completed</span></td>
            </tr>

            <tr>
                <td>Dawson Smith</td>
                <td>Rs. 1200</td>
                <td>-</td>
                <td><span class="status return">Cancelled</span></td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- ================= New Customers ================ -->
    <div class="recentCustomers">
        <div class="cardHeader">
            <h2>Recent Customers</h2>
        </div>

        <table>
            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer02.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Kasun<br> <span>Panadura</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer04.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Mario<br> <span>Negombo</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer01.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Abisheke <br> <span>Hambanthota</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer03.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Nimal<br> <span>Jaffna</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer02.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Tithira <br> <span>Havelock</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer01.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Pasan <br> <span>Kaluthara</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer01.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Sahan <br> <span>Galle</span></h4>
                </td>
            </tr>

            <tr>
                <td width="60px">
                    <div class="imgBx"><img src="assets/technician-dashboard/customer02.jpg" alt=""></div>
                </td>
                <td>
                    <h4>Amit <br> <span>India</span></h4>
                </td>
            </tr>
        </table>
    </div>
</div>
</div>
</div>

<div id="signOutOverlay" class="overlay">
    <div class="overlay-content">
        <p>Are you sure you want to sign out?</p>
        <button id="confirmSignOut" class="btn"><a href="/service-center-logout"></a> Yes</button>
        <button id="cancelSignOut" class="btn">No</button>
    </div>
</div>
<!--    Icons-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="/js/customer/overlay.js"></script>
</body>
</html>