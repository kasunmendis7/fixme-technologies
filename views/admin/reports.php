<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Reports</title>
        <link rel="stylesheet" href="/css/admin/admin-dashboard.css">
        <link rel="stylesheet" href="/css/admin/reports.css">
    </head>
    <body>
    <?php
    include_once 'components/sidebar.php';
    include_once 'components/header.php';
    ?>
    <div class="promotion-container">
    <div class="promotion-form">
        <h2>Create Report</h2>
        <form>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter username" required />
            </div>
            
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option>Select Role</option>
                    <option>Customer</option>
                    <option>Technician</option>
                    <option>Service Centre</option>
                </select>
            </div>
            <div class="form-group">
                <label for="start-date">Start Date</label>
                <input type="date" id="start-date" name="start-date" />
            </div>
            <div class="form-group">
                <label for="end-date">End Date</label>
                <input type="date" id="end-date" name="end-date" />
            </div>
            <div class="form-group">
                <button type="submit">Generate Report</button>
            </div>
        </form>
    </div>
</div>

    
    
    
    
    <script src="/js/admin/main.js"></script>
    
    </body>


    

                
    <!--    Icons-->

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    </body>
</html>