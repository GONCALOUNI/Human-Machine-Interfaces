<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="3; url=index.php"/>
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
            background-image: url('images/birdy.jpg');
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
            vertical-align: bottom;
            white-space: nowrap;
        }

        .card-registration .select-input.form-control[readonly]:not([disabled]) {
            font-size: 1rem;
            line-height: 2.15;
            padding-left: .75em;
            padding-right: .75em;
        }

        .card-registration .select-arrow {
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
    </style>
</head>
<body>
    <nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <img src="images/logo.png" alt="PetinhosTalk" style="height: 40px;">
            <span class="slogan text-center">Where pets love... finds its place!</span>
        </div>
    </nav>
    <section class="h-100">
        <div class="container shadow">
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-xl-6 d-none d-xl-block">
                    </div>
                    <div class="card card-registration my-4">
                        <div class="card-body p-md-5 text-black">
                            <h2 class="mb-4 text-uppercase text-center">{$MESSAGE}</h2>
                            <p>You'll be redirected to our homepage in 3 seconds...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>