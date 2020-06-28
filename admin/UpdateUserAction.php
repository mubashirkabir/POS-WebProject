<?php
require_once("../config.php");

session_start();
if (!(isset($_SESSION['userName']))) {
    header("Location: /WebProject");
}

if (!($_SESSION['userName'] == 'admin')) {
    header("Location: /WebProject");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    if (mysqli_connect_error()) {
        die(mysqli_connect_error());
    }
    $userId = $_POST["UserId"];
    $fullname = $_POST["FullName"];
    $username  = $_POST["UserName"];
    $password = md5($_POST["UserPassword"]);
    $role = $_POST["role"];
    $sql = "UPDATE `users` SET `FullName` = '$fullname', `UserName` = '$username', `UserPassword` = '$password', `UserRole` = '$role' WHERE `Id` = $userId";
    $result = mysqli_query($connection, $sql);
    if (mysqli_error($connection)) {
        die("Error, Something wrong with your database. ");
    }
    mysqli_close($connection);
    header("Location: /WebProject/admin/manage.php");
}


?>