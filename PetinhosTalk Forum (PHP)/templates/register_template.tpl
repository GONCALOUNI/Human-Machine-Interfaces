<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PetinhosTalk Forum</title>
    <style>
        .bg-light
        {
            background-color: #f87538!important;
        }

        .navbar-nav .nav-link
        {
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar-nav .nav-link:hover
        {
            background-color: #f87538;
            color: #ffffff!important;
        }

        .welcome
        {
            color: #f87538;
        }

        body
        {
            background-image: url('images/pets register.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container
        {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
        }

        .slogan
        {
            font-size: 16px;
            font-style: italic;
            color: #555555;
            margin-left: 10px;
            vertical-align: bottom;
            white-space: nowrap;
        }

        .form-control
        {
            border-color: #aaaaaa!important;
        }

        a
        {
            color: #f87538;
        }

        .btn-warning
        {
            color: #ffffff;
            background-color: #f87538;
            border-color: #f87538;
        }

        .btn-warning:hover
        {
            background-color: #f87538;
            color: #ffffff;
            border-color: #f87538;
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
                    <div class="col-xl-6 d-none d-xl-block">
                        <img src="images/design.jpg" alt="Sample photo" class="img-fluid" style="border-radius: 8px;">
                    </div>
                    <div class="col-xl-6">
                        <div class="card card-registration my-4">
                            <div class="card-body p-md-5 text-black">
                                <h3 class="mb-5 text-uppercase">Join our family!</h3>
                                {if isset($ERROR_TYPE) || isset($MESSAGE)}
                                    <h4 class="text-center text-danger mb-5 text-uppercase">
                                        {if isset($ERROR_TYPE)}{$ERROR_TYPE}{/if}
                                        {if isset($MESSAGE)}{$MESSAGE}{/if}
                                    </h4>
                                {/if}
                                <form id="registrationForm" action="register_action.php" method="post">
                                    <div class="form-group">
                                        <label for="form3Example1m">Your name:</label>
                                        <input type="text" id="form3Example1m" name="name" class="form-control form-control-lg" placeholder="Input your name please" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="form3Example97">Your e-mail address:</label>
                                        <input type="email" id="form3Example97" name="email" class="form-control form-control-lg" placeholder="someone@mail.com" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="form3Example8">Desired password:</label>
                                        <input type="password" id="form3Example8" name="password" class="form-control form-control-lg" placeholder="Enter password" required>
                                    </div>

                                    <div class="form-group">
                                        <label for="form3Example90">Password confirmation:</label>
                                        <input type="password" id="form3Example90" name="password_confirmation" class="form-control form-control-lg" placeholder="Retype password" required>
                                    </div>

                                    <div class="d-flex justify-content-end pt-3">
                                        <button type="reset" class="btn btn-light btn-lg">Clear</button>
                                        <button type="submit" class="btn btn-warning btn-lg ms-2">Register Account</button>
                                    </div>
                                    <p class="text-center mt-3">
                                        Already have an account? <a href="login_template.html">Login here!</a>
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
