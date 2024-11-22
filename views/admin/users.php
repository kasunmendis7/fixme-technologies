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
        <div class="details">
            <div class="recentOrders">
                <div class="cardHeader">
                    <h2>Users </h2>
                    <a href="#" class="btn">View All</a>
                </div>

                <table>
                    <thead>
                    <tr>
                        <td>Name</td>
                        <td>Role</td>
                        <td>Phone No</td>
                        <td>Email Adress</td>
                    </tr>
                    </thead>

                    <tbody>
                    <tr>
                        <td>Kasun Mendis</td>
                        <td>Technician</td>
                        <td>Due</td>
                        <td><span class="status inProgress">In Progress</span></td>
                    </tr>
                    <tr>
                        <td>Sheane Mario</td>
                        <td>Consumer</td>
                        <td>0763432134</td>
                        <td><span class="status delivered">Completed</span></td>
                    </tr>

                    <tr>
                        <td>Pulasthi Abhisheke</td>
                        <td>Technician</td>
                        <td>0734323213</td>
                        <td><span class="status pending">Pending</span></td>
                    </tr>

                    <tr>
                        <td>Nimal Rathinarasa</td>
                        <td>Customer</td>
                        <td>0764525544</td>
                        <td><span class="status return">Cancelled</span></td>
                    </tr>

                    <tr>
                        <td>Jimmy Donaldson</td>
                        <td>Service Center</td>
                        <td>0752522342</td>
                        <td><span class="status inProgress">In Progress</span></td>
                    </tr>

                    
                    </tbody>
                </table>
            </div>


                
    <!--    Icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>
