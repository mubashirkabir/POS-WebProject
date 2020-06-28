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
    
    $CustomerID = $_POST["CustomerID"];
    $CustomerName  = $_POST["CustomerName"];
    $CustomerPhone = $_POST["CustomerPhone"];
    $Memebership = $_POST["mtype"];
    $expiryDate = $_POST['expiry'];

    $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    if (mysqli_connect_error()) {
        die(mysqli_connect_error());
    }

    $sql = "UPDATE `customers` SET `CustomerName` = '$CustomerName', `CustomerPh` = '$CustomerPhone ', `CustomerMembership` = '$Memebership',  `MembershipExpiry` = '$expiryDate' WHERE `CustomerId` = '$CustomerID'";;
    $result = mysqli_query($connection, $sql);
    if (mysqli_error($connection)) {
        die("Error, Something wrong with your database. ");
    }
    mysqli_close($connection);
    header("Location: /WebProject/admin/Customers.php");
}
