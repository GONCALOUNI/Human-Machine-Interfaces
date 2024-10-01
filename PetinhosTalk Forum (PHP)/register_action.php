<?php
require('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

    if ($db) {
        $error_message = '';

        if (empty($name) || empty($email) || empty($password) || empty($password_confirmation)) {
            $error_message = "Missing input fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = "Invalid email format.";
        } elseif ($password !== $password_confirmation) {
            $error_message = "Passwords do not match.";
        } else {
            $queryUsername = "SELECT COUNT(*) FROM users WHERE name = '$name'";
            $queryEmail = "SELECT COUNT(*) FROM users WHERE email = '$email'";

            $resultUsername = mysqli_query($db, $queryUsername);
            $resultEmail = mysqli_query($db, $queryEmail);

            $countUsername = mysqli_fetch_row($resultUsername)[0];
            $countEmail = mysqli_fetch_row($resultEmail)[0];

            if ($countUsername > 0) {
                $error_message = "Username already exists.";
            } elseif ($countEmail > 0) {
                $error_message = "Email already exists.";
            } else {
                $password = substr(md5($password), 0, 32);
                $query = "INSERT INTO users (name, email, password_digest, created_at, updated_at) VALUES ('$name', '$email', '$password', '$created_at', '$updated_at')";
                $result = mysqli_query($db, $query);
                if ($result) {
                    $_SESSION['MESSAGE'] = "Register Success!";
                    header("Location: message.php");
                    exit;
                } else {
                    $error_message = "Register error: " . mysqli_error($db);
                }
            }
        }

        if (!empty($error_message)) {
            $_SESSION['MESSAGE_ERROR'] = true;
            $_SESSION['ERROR_TYPE'] = $error_message;
            header("Location: register.php");
            exit;
        }
        db_close($db);
    } else {
        $error_message = "Database connection error.";
        $_SESSION['MESSAGE_ERROR'] = true;
        $_SESSION['ERROR_TYPE'] = $error_message;
        header("Location: register.php");
        exit;
    }
}
?>