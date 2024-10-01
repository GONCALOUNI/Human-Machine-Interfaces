<?php
require('db.php');
$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");
    if($db)
    {
        if(empty($name) || empty($email) || empty($password) || empty($password_confirmation)) {die("Error: Missing input fields. Please go back and fill in all the required fields.");}
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {die("Error: Invalid email format. Please provide a valid email address.");}
        if($password !== $password_confirmation) {die("Error: Passwords do not match. Please make sure the passwords match.");}

        $usernameCheck = "SELECT COUNT(*) FROM users WHERE name = '$name'";
        $result = mysqli_query($db, $usernameCheck);
        $count = mysqli_fetch_row($result)[0];
        if($count > 0) {die("Error: Username already exists. Please choose a different username.");}

        $emailCheck = "SELECT COUNT(*) FROM users WHERE email = '$email'";
        $result = mysqli_query($db, $emailCheck);
        $count = mysqli_fetch_row($result)[0];
        if($count > 0) {die("Error: Email already exists. Please use a different email address.");}
        else
        {
            $password = substr(md5($password), 0, 32);
            $insertQuery = "INSERT INTO users (name, email, created_at, updated_at, password_digest) VALUES ('$name', '$email', '$created_at', '$updated_at', '$password')";
            $result = mysqli_query($db, $insertQuery);
            if($result)
            {
                mysqli_close($db);
                header("Location: register_success.html");
                die;
            }
            else
            {
                die("Error: " . mysqli_error($db));
            }
        }
    }
    else
    {
        die("Error: Database connection error");
    }
}
?>