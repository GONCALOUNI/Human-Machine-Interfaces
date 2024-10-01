<?php
require('db.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        exit();
    }
    $created_at = date("Y-m-d H:i:s");
    $updated_at = date("Y-m-d H:i:s");

    $db = dbconnect($hostname, $db_name, $db_user, $db_passwd);

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['id'];

        if (isset($_POST['go'])) {
            $blogContent = $_POST['content'];

            $insertQuery = "INSERT INTO microposts (content, user_id, created_at, updated_at) VALUES (?, ?, ?, ?)";
            $insertStatement = $db->prepare($insertQuery);

            if (!$insertStatement) {
                $_SESSION['MESSAGE'] = "ERROR: Failed to prepare the query: " . $db->error;
            } else {
                $insertStatement->bind_param('siss', $blogContent, $user_id, $created_at, $updated_at);

                if ($insertStatement->execute()) {
                    $_SESSION['MESSAGE'] = "SUCCESS: New post submitted";
                } else {
                    $_SESSION['MESSAGE'] = "ERROR: Failed to execute the query: " . $insertStatement->error;
                }
            }
        } else {
            $_SESSION['MESSAGE'] = "ERROR: Missing blog content";
        }
    } else {
        $_SESSION['MESSAGE'] = "ERROR: Login first";
    }

    header("Location: message.php");
    exit();
}
?>