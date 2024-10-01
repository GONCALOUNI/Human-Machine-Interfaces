<?php
/* Smarty version 3.1.33-dev-7, created on 2023-11-05 23:48:50
  from '/users/a76967/public_html/LAB7/templates/login_template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-dev-7',
  'unifunc' => 'content_65481bd264c1c5_01955318',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8bd2134c0e6fc785e48d04b0a55cf60007d2c280' => 
    array (
      0 => '/users/a76967/public_html/LAB7/templates/login_template.tpl',
      1 => 1699224439,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65481bd264c1c5_01955318 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetinhosTalk Forum</title>
    <style>
        .bg-light {
            background-color: #f87538!important;
        }

        .navbar-nav .nav-link {
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link:hover {
            background-color: #f87538;
            color: #ffffff!important;
        }

        .welcome {
            color: #f87538;
        }

        body {
            background-image: url('images/ducks.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .slogan {
            font-size: 16px;
            font-style: italic;
            color: #555555;
            margin-left: 10px;
            vertical-align: bottom;~
            white-space: nowrap;
        }

        .card-login .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-login .select-arrow {
            top: 13px;
        }

        .form-control {
            border-color: #aaaaaa!important;
        }

        a {
            color: #f87538;
        }

        .btn-warning {
            color: #ffffff;
            background-color: #f87538;
            border-color: #f87538;
        }

        .btn-warning:hover {
            background-color: #f87538;
            color: #ffffff;
            border-color: #f87538;
        }

        html {
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <img src="images/logo.png" alt="PetinhosTalk" style="height: 40px;">
        <span class="slogan">Where pets love... finds its place!</span>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <?php echo $_smarty_tpl->tpl_vars['MENU_1']->value;?>

            </li>
            <?php if (isset($_smarty_tpl->tpl_vars['WELCOME']->value)) {?>
                <li class="nav-item">
                    <?php echo $_smarty_tpl->tpl_vars['MENU_2']->value;?>

                </li>
            <?php }?>
            <li class="nav-item">
                <?php echo $_smarty_tpl->tpl_vars['MENU_3']->value;?>

            </li>
            <?php if (!isset($_smarty_tpl->tpl_vars['WELCOME']->value)) {?>
                <li class="nav-item">
                    <?php echo $_smarty_tpl->tpl_vars['MENU_4']->value;?>

                </li>
            <?php }?>
        </ul>
        <?php if (isset($_smarty_tpl->tpl_vars['WELCOME']->value)) {?>
            <?php echo $_smarty_tpl->tpl_vars['WELCOME']->value;?>

        <?php }?>
    </div>
    </nav>
    <section class="h-100">
        <div class="container shadow">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-6">
                        <div class="card card-login my-4">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="text-center mb-5 text-uppercase">Login here!</h3>
                                <?php if (isset($_smarty_tpl->tpl_vars['ERROR_TYPE']->value) || isset($_smarty_tpl->tpl_vars['MESSAGE']->value)) {?>
                                    <h4 class="text-center text-danger mb-5 text-uppercase">
                                        <?php if (isset($_smarty_tpl->tpl_vars['ERROR_TYPE']->value)) {
echo $_smarty_tpl->tpl_vars['ERROR_TYPE']->value;
}?>
                                        <?php if (isset($_smarty_tpl->tpl_vars['MESSAGE']->value)) {
echo $_smarty_tpl->tpl_vars['MESSAGE']->value;
}?>
                                    </h4>
                                <?php }?>
                                <form id="loginForm" action="login_action.php" method="post">
                                    <div class="form-group">
                                        <label for="form3Example1m">Your e-mail:</label>
                                        <input type="text" id="form3Example1m" name="email" class="form-control form-control-lg" placeholder="someone@email.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="form3Example97">Your password:</label>
                                        <input type="password" id="form3Example97" name="password" class="form-control form-control-lg" placeholder="Enter password">
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="autologin" value="1" class="form-check-input">
                                        <label class="form-check-label" for="autologin">Remember me</label>
                                    </div>
                                    <div class="d-flex justify-content-center pt-3">
                                        <button type="submit" class="btn btn-warning btn-lg ms-2">Login</button>
                                    </div>
                                    <p class="text-center mt-3">
                                        <a href="password_reset.php"><u>Forgot your password?</u></a>
                                    </p>
                                    <p class="text-center my-3">
                                        Not a member yet? <a href="register.php">Register your free account here!</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html><?php }
}
