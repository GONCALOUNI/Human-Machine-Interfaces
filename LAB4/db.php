<?php
$hostname = "10.10.23.184";
$db_name = "db_a76967";
$db_user = "a76967";
$db_passwd = "89c5f8";

function showerror($db)
{
    die("Error " . mysqli_errno($db) . " : " . mysqli_error($db));
}

function dbconnect($hostname, $db_name,$db_user,$db_passwd)
{
    $db = @ mysqli_connect($hostname, $db_user, $db_passwd,$db_name);
    if(!$db)
    {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $db;
}

function db_close($db)
{
    mysqli_close($db);
}
?>