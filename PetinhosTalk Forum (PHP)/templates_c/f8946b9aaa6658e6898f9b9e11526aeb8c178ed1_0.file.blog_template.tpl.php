<?php
/* Smarty version 3.1.33-dev-7, created on 2023-11-06 12:08:26
  from '/users/a76967/public_html/LAB7/templates/blog_template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-dev-7',
  'unifunc' => 'content_6548c92ab868b7_53796678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8946b9aaa6658e6898f9b9e11526aeb8c178ed1' => 
    array (
      0 => '/users/a76967/public_html/LAB7/templates/blog_template.tpl',
      1 => 1699224439,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6548c92ab868b7_53796678 (Smarty_Internal_Template $_smarty_tpl) {
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
            background-image: url('images/blog.png');
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

        .form-control {
            border-color: #aaaaaa!important;
        }

        a {
            color: #f87538;
        }

        .btn-green {
            color: #ffffff;
            background-color: #4CAF50;
            border-color: #4CAF50;
        }

        .btn-red {
            color: #ffffff;
            background-color: #F44336;
            border-color: #F44336;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .btn-green {
            margin-right: 10px;
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
    <div class="container position-relative shadow">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <form action="newblog_action.php" method="post">
                    <textarea name="content" rows="10" cols="50" style="resize: none;"></textarea>
                    <div class="button-container">
                        <button type="submit" class="btn btn-green btn-lg center" name="go">Go</button>
                        <button type="submit" class="btn btn-red btn-lg ms-2 center" name="cancel" formnovalidate>Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
</body>
</html><?php }
}
