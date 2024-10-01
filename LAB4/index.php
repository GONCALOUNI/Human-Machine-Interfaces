<?php
require('/usr/share/php/smarty/libs/Smarty.class.php');
require('db.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

if($db)
{
    $query = "SELECT u.name, m.* FROM microposts AS m INNER JOIN users AS u ON u.id = m.user_id ORDER BY m.updated_at DESC";
    $result = mysqli_query($db, $query);
    if($result) 
    {
        $data = array();
        while($row = mysqli_fetch_assoc($result))
        {
            $data[] = $row;
        }
        $smarty->assign('microposts', $data);
    } 
    else 
    {
        $smarty->assign('microposts', array());
    }

    mysqli_close($db);
}
else 
{
    $smarty->assign('dados', array());
}
$smarty->display('index_template.tpl');
?>