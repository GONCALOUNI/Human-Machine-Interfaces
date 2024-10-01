<?php
require('db.php');
require('/usr/share/php/smarty/libs/Smarty.class.php');

$smarty = new Smarty();
session_start();

if (isset($_SESSION['MESSAGE'])) {
    $message = $_SESSION['MESSAGE'];
} else {
    $message = "See you back soon!";
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$smarty->assign('MESSAGE', $message);
$smarty->display('message_template.tpl');
?>