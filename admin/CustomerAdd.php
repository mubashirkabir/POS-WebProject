<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>POS</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="../assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="../assets/css/styles.css">

    <?php
    require_once("../config.php");

    $id = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $CustomerID = $_POST["CustomerID"];
        $CustomerName  = $_POST["CustomerName"];
        $CustomerPhone = $_POST["CustomerPhone"];
        $Memebership = $_POST["mtype"];
        $expiryDate = date('Y-m-d', strtotime("+3 months"));

        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }
        $sql = "INSERT INTO `customers`(`CustomerId`, `CustomerName`, `CustomerPh`, `CustomerMembership`, `MembershipExpiry`)  VALUES ( '$CustomerID' , '$CustomerName' , '$CustomerPhone', '$Memebership', '2019-08-22')";

        $result = mysqli_query($connection, $sql);
        if (mysqli_error($connection)) {
            die("Something went wrong! Check your Database");
        }
        mysqli_close($connection);
        header("Location: /WebProject/admin/Customers.php");
    }
    ?>
</head>

<body>

    <?php
    include_once("Header.php");
    ?>
</body>

</html>