<?php
    require_once("../config.php");
    session_start();
    if (!(isset($_SESSION['userName']))) {
        header("Location: /WebProject");
    }
    
    if(!($_SESSION['userName'] == 'admin')){
        header("Location: /WebProject");

    }
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $pid = $_POST["ProductID"];
    $pname  = $_POST["ProductName"];
    $pprice = $_POST["Price"];
    $pquantity = $_POST["Quantity"];
    $pdes = $_POST["ProductDescription"];

    $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    if (mysqli_connect_error()) {
        die(mysqli_connect_error());
    }

    $sql = "UPDATE `products` SET `ProductId` = '$pid', `ProductName` = '$pname', `ProductPrice` = '$pprice', `ProductQuantity` = '$pquantity', `ProductDescription` = '$pdes' WHERE `ProductId` = '$pid'";
    $result = mysqli_query($connection, $sql);
    if (mysqli_error($connection)) {
        die("Error, Something wrong with your database. ");
    }
    mysqli_close($connection);
    header("Location: /WebProject/admin");
}
