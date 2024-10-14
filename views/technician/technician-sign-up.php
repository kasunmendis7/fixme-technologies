<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Technician Sign Up</title>
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
                <h2>Become a Registered Technician</h2>
            </div>

            <form action="" method="post" class="technician-signup-form">
                <?php $form = \app\core\form\Form::begin('', 'post') ?>
                <?php echo $form->field($model, 'username') ?>
                <?php echo $form->field($model, 'nic') ?>
                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'password')->passwordField() ?>
                <?php echo $form->field($model, 'confirmPassword')->passwordField() ?>
                <button type="submit" class="btn">Create an account</button>
                <?php echo \app\core\form\Form::end();?>
<!--                <div class="input-element">-->
<!--                    <label for="username">Username: </label>-->
<!--                    <input type="text" name="username" value="--><?php //echo $model->username ?? '' ?><!--"-->
<!--                           placeholder="Username..."-->
<!--                           id="username"-->
<!--                           class="form-control--><?php //echo $model->hasError('username') ? ' is-invalid' : '' ?><!--">-->
<!--                    <div class="invalid-feedback">-->
<!--                        --><?php //echo $model->getFirstError('username'); ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="input-element">-->
<!--                    <label for="nic">NIC No: </label>-->
<!--                    <input type="text" name="nic" value="--><?php //echo $model->nic ?? '' ?><!--" placeholder="NIC No..."-->
<!--                           id="nic" class="form-control--><?php //echo $model->hasError('nic') ? ' is-invalid' : '' ?><!--">-->
<!--                    <div class="invalid-feedback">-->
<!--                        --><?php //echo $model->getFirstError('nic'); ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="input-element">-->
<!--                    <label for="email">Email address</label>-->
<!--                    <input type="email" name="email" id="email" value="--><?php //echo $model->email ?? '' ?><!--"-->
<!--                           placeholder="example@email.com..."-->
<!--                           class="form-control--><?php //echo $model->hasError('email') ? ' is-invalid' : '' ?><!--">-->
<!--                    <div class="invalid-feedback">-->
<!--                        --><?php //echo $model->getFirstError('email'); ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="input-element">-->
<!--                    <label for="password">Password</label>-->
<!--                    <input type="password" name="password" id="password" value="--><?php //echo $model->password ?? '' ?><!--"-->
<!--                           placeholder="Password..."-->
<!--                           class="form-control--><?php //echo $model->hasError('password') ? ' is-invalid' : '' ?><!--">-->
<!--                    <div class="invalid-feedback">-->
<!--                        --><?php //echo $model->getFirstError('password'); ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="input-element">-->
<!--                    <label for="confirmPassword">Password</label>-->
<!--                    <input type="password" name="confirmPassword" id="confirmPassword"-->
<!--                           value="--><?php //echo $model->confirmPassword ?? '' ?><!--" placeholder="Confirm password..."-->
<!--                           class="form-control--><?php //echo $model->hasError('confirmPassword') ? ' is-invalid' : '' ?><!--">-->
<!--                    <div class="invalid-feedback">-->
<!--                        --><?php //echo $model->getFirstError('confirmPassword'); ?>
<!--                    </div>-->
<!--                </div>-->
<!--                <h6>Use 8 or more characters with a mix of letters, numbers & symbols</h6>-->
<!---->
<!--                <div class="terms-cond">-->
<!--                    <input type="checkbox" name="terms-cond" id="terms-cond">-->
<!--                    <label for="terms-cond">I agree to the terms and conditions</label>-->
<!--                </div>-->
<!--                <div class="not-robot">-->
<!--                    <input type="checkbox" name="not-robot" id="not-robot">-->
<!--                    <label for="not-robot">I'm not a robot</label>-->
<!--                </div>-->
<!--                <div>-->
<!--                    <button type="submit" class="btn">Create an account</button>-->
<!--                </div>-->
                <div class="log-in">
                    <h6>Already have an account? <a href="/technician-log-in">Log in</a></h6>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>