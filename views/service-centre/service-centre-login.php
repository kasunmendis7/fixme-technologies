
<?php

/** @var $model \app\models\ServiceCentre */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Centre Login</title>
    <link rel="stylesheet" href="/css/service-center/service-centre-login.css">
    <link rel="stylesheet" href="/css/base/_reset.css">
    <link rel="stylesheet" href="/css/base/_global.css">
</head>

<body>
<?php if (Application::$app->session->getFlash('success')): ?>
    <div class="alert alert-success">
        <?php echo Application::$app->session->getFlash('success') ?>
    </div>
<?php endif; ?>
<div class="container">
    <div class="box-1">
        <div class="branding">
            <div>
                <a href="/" class="brand-name">
                    <span class="brand-button">FixMe</span>
                </a>
            </div>
            <p class="tagline">Expert Car Care, Anytime, Anywhere.</p>
        </div>
    </div>
    <div class="box-2">
        <div class="wrapper">
            <div class="title-1">
                <h2>Service Centre Login</h2>
            </div>
            <form action="" method="post" class="login-form">
                <div class="input-element">
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" placeholder="example@email.com..." required>
                </div>
                <div class="input-element">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password..." required>
                </div>
                <div class="remember-me">
                    <input type="checkbox" name="remember-me" id="remember-me">
                    <label for="remember-me">Remember me</label>
                </div>
                <div>
                    <button type="submit" class="btn">Log in</button>
                </div>
                <div class="forgot-password">
                    <a href="#">Forgot password?</a>
                </div>
                <div class="sign-up">
                    <h6>Don't have an account? <a href="/service-centre-sign-up">Sign up</a></h6>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>