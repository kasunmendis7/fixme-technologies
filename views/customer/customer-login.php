<?php

/** @var $model \app\models\Customer */

use app\core\Application;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Log In</title>
    <link rel="stylesheet" href="/css/customer/customer-sign-up.css">
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
                <h2>Login to your Account</h2>
                <h5>Don't have an account? <a href="/customer-sign-up">Sign Up</a></h5>
            </div>
            <form action="" method="post" class="cust-signup-form">
                <div class="input-element">
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" value="<?php echo $model->email ?>"
                           class="<?php echo $model->hasError('email') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('email') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" value="<?php echo $model->password ?>"
                           class="<?php echo $model->hasError('password') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('password') ?>
                    </div>
                </div>
                <div class="not-robot">
                    <input type="checkbox" name="not-robot" id="not-robot">
                    <label for="not-robot">I'm not a robot</label>
                </div>
                <div>
                    <button type="submit" class="btn">Log In</button>
                </div>
                <div class="log-in">
                    <h6>Dont't have an account? <a href="/customer-sign-up">Sign Up</a></h6>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>