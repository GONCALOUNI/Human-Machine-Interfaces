<?php
require('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

    if ($db) {
        if (empty($email) || empty($password)) {
            $_SESSION['email'] = $email;
            $_SESSION['MESSAGE_ERROR'] = true;
            $_SESSION['ERROR_TYPE'] = 'Wrong email or password';
            header("Location: login.php");
            exit;
        }

        $email = mysqli_real_escape_string($db, $email);
        $query = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $query);

        if ($result && mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);
            $password = substr(md5($password), 0, 32);

            if ($password === $user['password_digest']) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['MESSAGE'] = 'Welcome back!';
                header("Location: message.php");
                exit;
            } else {
                $_SESSION['email'] = $email;
                $_SESSION['MESSAGE_ERROR'] = true;
                $_SESSION['ERROR_TYPE'] = 'Wrong email or password.';
                header("Location: login.php");
                exit;
            }
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['MESSAGE_ERROR'] = true;
            $_SESSION['ERROR_TYPE'] = 'Wrong email or password.';
            header("Location: login.php");
            exit;
        }
        db_close($db);
    } else {
        $_SESSION['MESSAGE_ERROR'] = true;
        $_SESSION['ERROR_TYPE'] = 'Database connection error.';
        header("Location: login.php");
        exit;
    }
}
?>