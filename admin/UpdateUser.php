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
    session_start();
    if (!(isset($_SESSION['userName']))) {
        header("Location: /WebProject");
    }

    if (!($_SESSION['userName'] == 'admin')) {
        header("Location: /WebProject");
    }

    if (!isset($_GET["id"])) {
        return;
    } else if (empty($_GET['id'])) {
        return;
    } else {
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }

        $id  = $_GET["id"];
        $sql = "SELECT * FROM users WHERE  Id = '$id'";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['FullName'];
            $uname = $row['UserName'];
            $password = $row['UserPassword'];
        }
    }
    ?>

</head>

<body>

    <?php
    include_once("Header.php");
    ?>

    <form method="post" action="\WebProject\admin\UpdateUserAction.php" id="addForm" class="border border-secondary" style=" padding: 15px; margin-top: 30px; width: 60%; margin-left: 20%; ">
        <input type="hidden" id="userid" name="UserId" value="<?php echo $id ?>">

        <div class="form-group">
            <label for="UserFullName">Full Name</label>
            <input type="text" class="form-control" id="FullName" placeholder="Enter Full Name" name="FullName" value="<?php echo $name ?>">
        </div>

        <div class="form-group">
            <label for="UserName">User Name</label>
            <input type="text" class="form-control" id="Username" placeholder="Enter User Name" name="UserName" value="<?php echo $uname ?>">
        </div>

        <div class="form-group">
            <label for="UserPassword">User Password</label>
            <input type="password" class="form-control" id="UserPassword" placeholder="Enter User Password" name="UserPassword" value="">
        </div>

        <div class="form-group">
            <label for="role">Select User Role</label>
            <select id="inputState" class="form-control" name="role">
                <option value="1">Admin (1)</option>
                <option selected value="2">Cashier (2)</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Update</button>
        <button onclick="cancel()" type="button" class="btn btn-primary">Cancel</button>
    </form>


    <script>
        document.getElementById("1").className = 'nav-link';
        document.getElementById("2").className = 'nav-link';
        document.getElementById("4").className = 'nav-link active';
        document.getElementById("5").className = 'nav-link';
        document.getElementById("6").className = 'nav-link';
        document.getElementById("7").className = 'nav-link';


        function cancel() {
            window.location.href = '/WebProject/admin/manage.php';

        }
    </script>

    <?php
    include_once("Footer.php");
    ?>