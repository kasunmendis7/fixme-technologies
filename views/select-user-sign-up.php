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
        <div class="col-left-container">
            <div class="branding-container">
                <div>
                    <a href="/" class="brand-name">
                        <span class="brand-button">FixMe</span>
                    </a>
                </div>
                <p class="tagline">Expert Car Care, Anytime, Anywhere.</p>
            </div>
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
                    Sign Up as a customer to find the best technicians in the nearby area.
                </p>
                <a href="/customer-sign-up" class="button">Sign Up</a>
            </div>

            <div class="card" onmouseover="hoverEffect(this)" onmouseout="removeHoverEffect(this)">
                <div class="icon">
                    <img src="assets/select-user-technician.png" alt="guider icon">
                </div>
                <h3 class="heading">Technician</h3>
                <p class="paragraph">
                    Sign Up as a Technician and find customers.
                </p>
                <a href="/technician-sign-up" class="button">Sign Up</a>
            </div>
            <div class="card" onmouseover="hoverEffect(this)" onmouseout="removeHoverEffect(this)">
                <div class="icon">
                    <img src="assets/select-user-service-centre.png" alt="guider icon">
                </div>
                <h3 class="heading">Service Center</h3>
                <p class="paragraph">
                    Sign Up as a Service Center and find customers.
                </p>
                <a href="/service-centre-sign-up" class="button">Sign Up</a>
            </div>
        </div>
    </div>

</section>

<script src="js/home/select-user-login.js"></script>
</body>
</html>
