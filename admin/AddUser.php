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
        $fullname = $_POST["FullName"];
        $username  = $_POST["UserName"];
        $password = md5($_POST["UserPassword"]);
        $role = $_POST["role"];

        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }
        $sql = "INSERT INTO users ( `FullName`, `UserName`, `UserPassword`, `UserRole`) VALUES ( '$fullname' , '$username' , '$password', '$role')";

        $result = mysqli_query($connection, $sql);
        if (mysqli_error($connection)) {
            die("Something went wrong! Check your Database");
        }
        mysqli_close($connection);
        header("Location: /WebProject/admin/Manage.php");
    }
    ?>
</head>

<body>

    <?php
    include_once("Header.php");
    ?>
</body>

</html>