<?php
// Simulating remote server response time

require_once("config.php");
$connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
if (mysqli_connect_error()) {
    die(mysqli_connect_error());
}

$username  = $_POST["u"];
$sql = "SELECT * FROM users WHERE  UserName= '$username'";
   $result = mysqli_query($connection, $sql);
   $row = mysqli_fetch_assoc($result);
                if($row > 0){
                     echo 'true';
                }else{
                    echo 'false';
                }
    ?>