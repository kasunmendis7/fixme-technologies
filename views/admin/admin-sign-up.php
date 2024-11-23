<?php
/** @var $model \app\models\Admin */
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Sign Up</title>
    <link rel="stylesheet" href="/css/admin/admin-sign-up.css">
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
                <h2>Become a FixMe Team Member</h2>
            </div>
            <form action="" method="post" class="admin-signup-form">
                <div class="input-element">
                    <label for="fname">First name:</label>
                    <input type="text" name="fname" placeholder="Firstname..." id="fname"
                           value="<?php echo $model->fname ?>"
                           class="<?php echo $model->hasError('fname') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('fname') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="lname">Last name:</label>
                    <input type="text" name="lname" placeholder="Lastname..." id="lname"
                           value="<?php echo $model->lname ?>"
                           class="<?php echo $model->hasError('lname') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('lname') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="phone_no">Phone Number: </label>
                    <input type="tel" name="phone_no" placeholder="Phone Number..." id="phone_no"
                           value="<?php echo $model->phone_no ?>"
                           class="<?php echo $model->hasError('phone_no') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('phone_no') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="address">Address: </label>
                    <input type="text" name="address" placeholder="Address..." id="address"
                           value="<?php echo $model->address ?>"
                           class="<?php echo $model->hasError('address') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('address') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="email">Email address:</label>
                    <input type="email" name="email" id="email" placeholder="example@email.com..."
                           value="<?php echo $model->email ?>"
                           class="<?php echo $model->hasError('email') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('email') ?>
                    </div>
                </div>
                <div class="input-element">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Password..."
                           value="<?php echo $model->password ?>"
                           class="<?php echo $model->hasError('password') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('password') ?>
                    </div>
                </div>
                <h6>Use 8 or more characters with a mix of letters, numbers & symbols</h6>
                <div class="input-element">
                    <label for="confirmPassword">Confirm Password:</label>
                    <input type="password" name="confirmPassword" id="confirmPassword"
                           placeholder="Re-enter password..." value="<?php echo $model->confirmPassword ?>"
                           class="<?php echo $model->hasError('confirmPassword') ? 'invalid ' : '' ?>">
                    <div class="invalid-feedback">
                        <?php echo $model->getFirstError('confirmPassword') ?>
                    </div>
                </div>

                <div class="terms-cond">
                    <input type="checkbox" name="terms-cond" id="terms-cond" required>
                    <label for="terms-cond">I agree to the terms and conditions</label>
                </div>
                <div class="not-robot">
                    <input type="checkbox" name="not-robot" id="not-robot" required>
                    <label for="not-robot">I'm not a robot</label>
                </div>
                <div>
                    <button type="submit" class="btn">Create an account</button>
                </div>
                <div class="log-in">
                    <h6>Already have an account? <a href="/admin-login">Log in</a></h6>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>