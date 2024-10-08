<?php
/* Smarty version 3.1.33-dev-7, created on 2023-11-05 03:42:42
  from '/users/a76967/public_html/LAB6/templates/index_template.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33-dev-7',
  'unifunc' => 'content_65470122192806_52774334',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8df3e00a3a0238ad6159c28964dae9ba4b728558' => 
    array (
      0 => '/users/a76967/public_html/LAB6/templates/index_template.tpl',
      1 => 1699152196,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_65470122192806_52774334 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
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
            background-image: url('images/pets.png');
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
        }
    
        .post
        {
            margin-bottom: 20px;
            border: 1px solid #aaaaaa;
            padding: 20px;
            border-radius: 8px;
        }
    
        .post-author
        {
            font-weight: bold;
            text-decoration: underline;
            color: #f87538;
        }
    
        .post-date
        {
            font-style: italic;
            color: #888888;
        }

        .post-update
        {
            font-style: italic;
            color: #888888;
        }
    
        .post-content
        {
            margin-top: 10px;
        }

        html
        {
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
    <div class="container shadow">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['microposts']->value, 'post');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['post']->value) {
?>
            <div class="post">
                <div class="post-author bold-text"><?php echo $_smarty_tpl->tpl_vars['post']->value['name'];?>
</div>
                <div class="post-date">Created at: <?php echo $_smarty_tpl->tpl_vars['post']->value['created_at'];?>
</div>
                <div class="post-update">Updated at: <?php echo $_smarty_tpl->tpl_vars['post']->value['updated_at'];?>
</div>
                <div class="post-content"><?php echo $_smarty_tpl->tpl_vars['post']->value['content'];?>
</div>
                <?php if (isset($_smarty_tpl->tpl_vars['_SESSION']->value['id']) && $_smarty_tpl->tpl_vars['_SESSION']->value['id'] == $_smarty_tpl->tpl_vars['post']->value['user_id']) {?>
                    <div class="post-update">
                        <a href="blog.php?micropost_id=<?php echo $_smarty_tpl->tpl_vars['post']->value['id'];?>
">Update Blog</a>
                    </div>
                <?php }?>
            </div>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
     </div>
</body>
</html><?php }
}
