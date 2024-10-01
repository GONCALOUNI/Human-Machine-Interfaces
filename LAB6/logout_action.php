<?php
session_start();
$_SESSION['MESSAGE'] = 'See you back soon!';
session_destroy();
header("Location: message.php");
exit;
?>