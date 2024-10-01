<!DOCTYPE html>
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
                {$MENU_1}
            </li>
            {if isset($WELCOME)}
                <li class="nav-item">
                    {$MENU_2}
                </li>
            {/if}
            <li class="nav-item">
                {$MENU_3}
            </li>
            {if !isset($WELCOME)}
                <li class="nav-item">
                    {$MENU_4}
                </li>
            {/if}
        </ul>
        {if isset($WELCOME)}
            {$WELCOME}
        {/if}
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
                                {if isset($ERROR_TYPE) || isset($MESSAGE)}
                                    <h4 class="text-center text-danger mb-5 text-uppercase">
                                        {if isset($ERROR_TYPE)}{$ERROR_TYPE}{/if}
                                        {if isset($MESSAGE)}{$MESSAGE}{/if}
                                    </h4>
                                {/if}
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
</html>