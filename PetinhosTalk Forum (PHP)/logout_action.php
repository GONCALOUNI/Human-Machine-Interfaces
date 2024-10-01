<?php
require('/usr/share/php/smarty/libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

session_start();

if (isset($_COOKIE['rememberMe'])) {
    unset($_COOKIE['rememberMe']);
    setcookie('rememberMe', NULL, -1, '/');
}

if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] == true) {
    $smarty->assign('MESSAGE', 'See you back soon!');
}

unset($_SESSION['user_logged_in']);
session_destroy();
header("Location: message.php");
exit;
?>