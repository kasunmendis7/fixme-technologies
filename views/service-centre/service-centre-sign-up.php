<?php

/** @var $model \app\models\ServiceCenter */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Centre Sign Up</title>
    <link rel="stylesheet" href="/css/technician/technician-sign-up.css">
    <link rel="stylesheet" href="/css/base/_reset.css">
    <link rel="stylesheet" href="/css/base/_global.css">
</head>

<body>
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
                <h2>Become a Registered Service Centre</h2>
            </div>
            <form action="" method="post" class="technician-signup-form">
                <div class="input-element">
                    <label for="user-name">Service centre name:</label>
                    <input type="text" name="name" placeholder="Service centre name..." id="name"
                           value="<?php echo $model->name ?>"
                           class="<?php echo $model->hasError('name') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('name') ?>
                    </div>
                </div>
                <!--                    <div class="input-element">-->
                <!--                        <label for="nic">NIC No: </label>-->
                <!--                        <input type="text" name="nic" placeholder="NIC No..." id="nic" value="-->
                <?php //echo $model->nic ?><!--" class="-->
                <?php //echo $model->hasError('nic') ? 'invalid ' : '' ?><!--">-->
                <!--                        <div class="invalid-feedback">-->
                <!--                            --><?php //echo $model->getFirstError('nic') ?>
                <!--                        </div>-->
                <!--                    </div>-->
                <div class="input-element">
                    <label for="phoneNumber">Phone No: </label>
                    <input type="text" name="phone_no" placeholder="Phone no..." id="phone_no"
                           value="<?php echo $model->phone_no ?>"
                           class="<?php echo $model->hasError('phone_no') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('phone_no') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="user-name">Address: </label>
                    <input type="text" name="address" placeholder="Address..." id="address"
                           value="<?php echo $model->address ?>"
                           class="<?php echo $model->hasError('address') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('address') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="services">Services: </label>
                    <input type="text" name="service_category" placeholder="Services." id="service_category"
                           value="<?php echo $model->service_category ?>">
                </div>
                <div class="input-element">
                    <label for="email">Email address</label>
                    <input type="email" name="email" id="email" placeholder="example@email.com..."
                           value="<?php echo $model->email ?>"
                           class="<?php echo $model->hasError('email') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('email') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Password..."
                           value="<?php echo $model->password ?>"
                           class="<?php echo $model->hasError('password') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('password') ?>
                    </div>
                </div>
                <h6>Use 8 or more characters with a mix of letters, numbers & symbols</h6>
                <div class="input-element">
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                           placeholder="Re-enter password..."
                           value="<?php echo $model->confirmPassword ?>"
                           class="<?php echo $model->hasError('confirmPassword') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('confirmPassword') ?>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn">Create an account</button>
                </div>
                <div class="log-in">
                    <h6>Already have an account? <a href="/service-centre-login">Log in</a></h6>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>