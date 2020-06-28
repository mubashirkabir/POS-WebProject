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
    session_start();
    if (!(isset($_SESSION['userName']))) {
        header("Location: /WebProject/admin/Customers.php");
    }

    if (!($_SESSION['userName'] == 'admin')) {
        header("Location: /WebProject/admin/Customers.php");
    }

    require_once("../config.php");
    $id = "";
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (!isset($_GET['id'])) {
            echo "id is not set";
            return;
        } else if (empty($_GET['id'])) {
            echo "id is empty";
            return;
        } else {
            $id = $_GET['id'];
            $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
            if (mysqli_connect_error()) {
                die(mysqli_connect_error());
            }
            $sql = "DELETE FROM customers WHERE CustomerId = $id";

            $result = mysqli_query($connection, $sql);
            if (mysqli_error($connection)) {
                die("Something went wrong! Check your Database");
            }
            mysqli_close($connection);
            header("Location: /WebProject/admin/Customers.php");
        }
    }
    ?>
</head>

<body>

    <?php
    include_once("Header.php");
    ?>
</body>

</html>