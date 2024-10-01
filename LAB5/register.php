<?php
require('/usr/share/php/smarty/libs/Smarty.class.php');
require('db.php');
$smarty = new Smarty();

$smarty->template_dir = 'templates';
$smarty->compile_dir = 'templates_c';

if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

    if($db)
    {
        $registrationFailed = false;
        if(empty($name) || empty($email) || empty($password) || empty($password_confirmation))
        {
            $registrationFailed = true;
            $errorType = 0;
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $registrationFailed = true;
            $errorType = 2;
        }
        elseif($password !== $password_confirmation)
        {
            $registrationFailed = true;
            $errorType = 4;
        }
        else
        {
            $query = "SELECT COUNT(*) FROM users WHERE email = '$email'";
            $result = mysqli_query($db, $query);
            $count = mysqli_fetch_row($result)[0];
            if($count > 0)
            {
                $registrationFailed = true;
                $errorType = 1;
            }
            else
            {
                $password = substr(md5($password), 0, 32);
                $query = "INSERT INTO users (name, email, password_digest, created_at, updated_at) VALUES ('$name', '$email', '$password', '$created_at', '$updated_at')";
                $result = mysqli_query($db, $query);
                if($result)
                {
                    header("Location: register_success.html");
                    exit;
                }
                else {echo "Register error: " . mysqli_error($db);}
            }
        }

        if($registrationFailed)
        {
            $smarty->assign('name', $name);
            $smarty->assign('email', $email);
            $smarty->assign('ERROR_TYPE', $errorType);
        }
        db_close($db);
    }
    else {die("Database connection error");
    }
}
else {$smarty->display('register_template.tpl');}
?>