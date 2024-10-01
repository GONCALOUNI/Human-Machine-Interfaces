<?php
require('/usr/share/php/smarty/libs/Smarty.class.php');
require('db.php');
session_start();

$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';


if (isset($_SESSION['MESSAGE_ERROR']) && $_SESSION['MESSAGE_ERROR']) {
    $smarty->assign('ERROR_TYPE', $_SESSION['ERROR_TYPE']);
    unset($_SESSION['MESSAGE_ERROR']);
}
$smarty->assign('MENU_1', '<a class="nav-link" href="index.php">Home</a>');

if (isset($_SESSION['name'])) {
    $menu3 = '<a class="nav-link text-center" href="logout_action.php">Logout</a>';
    $smarty->assign('WELCOME', '<span class="nav-link text-center welcome">Welcome ' . $_SESSION['name'] . '</span>');
} else {
    $menu3 = '<a class="nav-link text-center" href="login.php">Login</a>';
    $smarty->assign('MENU_4', '<a class="nav-link" href="register.php">Register</a>');
}

$smarty->assign('MENU_2', '<a class="nav-link text-center" href="blog.php">Post blog</a>');
$smarty->assign('MENU_3', $menu3);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$smarty->display('register_template.tpl');
?>