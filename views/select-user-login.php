<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select User</title>
    <link rel="stylesheet" href="css/home/select-user-login.css">

</head>
<body>
<section>
    <!-- Left Column -->
    <div class="container-left">

        <div class="logo-container">
            <a href="/">
            <img style="width: 600px;" src="/assets/logo/fixme-logo.png">
            </a>
        </div>

    </div>

    <!-- Right Column -->
    <div class="container-right">
        <div class="container">
            <div class="card" onmouseover="hoverEffect(this)" onmouseout="removeHoverEffect(this)">
                <div class="icon">
                    <img src="assets/user_avatar.png" alt="Customer icon">
                </div>
                <h3 class="heading">Customer</h3>
                <p class="paragraph">
                    Log in as a customer to find the best technicians in the nearby area.
                </p>
                <a href="/customer-login" class="button">Log in</a>
            </div>

            <div class="card" onmouseover="hoverEffect(this)" onmouseout="removeHoverEffect(this)">
                <div class="icon">
                    <img src="assets/select-user-technician.png" alt="Technician icon">
                </div>
                <h3 class="heading">Technician</h3>
                <p class="paragraph">
                    Log in as a Technician and find customers.
                </p>
                <a href="/technician-login" class="button">Log in</a>
            </div>

            <div class="card" onmouseover="hoverEffect(this)" onmouseout="removeHoverEffect(this)">
                <div class="icon">
                    <img src="assets/select-user-service-centre.png" alt="Service Center icon">
                </div>
                <h3 class="heading">Service Center</h3>
                <p class="paragraph">
                    Log in as a Service Center and find customers.
                </p>
                <a href="/service-centre-login" class="button">Log in</a>
            </div>
        </div>
    </div>
</section>

<script src="js/home/select-user-login.js"></script>
</body>
</html>
