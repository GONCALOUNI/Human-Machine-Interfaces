<?php
require('/usr/share/php/smarty/libs/Smarty.class.php');
require('db.php');
$smarty = new Smarty();
$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

session_start();

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

if ($db) {
    $query = "SELECT u.name, m.* FROM microposts AS m INNER JOIN users AS u ON u.id = m.user_id ORDER BY m.updated_at DESC";
    $result = mysqli_query($db, $query);
    if ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        $smarty->assign('microposts', $data);
    } else {
        $smarty->assign('microposts', array());
    }

    mysqli_close($db);
} else {
    $smarty->assign('microposts', array());
}

$smarty->assign('MENU_1', '<a class="nav-link" href="index.php">Home</a>');

if (isset($_SESSION['name'])) {
    $smarty->assign('MENU_2', '<a class="nav-link text-center" href="blog.php">Post blog</a>');
    $menu3 = '<a class="nav-link text-center" href="logout_action.php">Logout</a>';
    $smarty->assign('WELCOME', '<span class="nav-link text-center welcome">Welcome ' . $_SESSION['name'] . '</span>');
} else {
    $menu3 = '<a class="nav-link text-center" href="login.php">Login</a>';
    $smarty->assign('MENU_4', '<a class="nav-link" href="register.php">Register</a>');
}

$smarty->assign('MENU_3', $menu3);

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$smarty->display('index_template.tpl');
?>
