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
        $sql = "SELECT * FROM customers WHERE  CustomerId = '$id'";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $CustomerID = $row['CustomerId'];
            $CustomerName  = $row["CustomerName"];
            $CustomerPhone = $row["CustomerPh"];
            $Memebership = $row["CustomerMembership"];
            $Expiry = $row['MembershipExpiry'];
        }
    }
    ?>

</head>

<body>

    <?php
    include_once("Header.php");
    ?>

    <<form method="post" action="CustomerEditAction.php" id="addForm" class="border border-secondary" style=" padding: 15px; margin-top: 30px; width: 60%; margin-left: 20%;">

        <div class="form-group">
            <label for="CustomerID">Customer ID</label>
            <input type="text" class="form-control" id="CustomerID" placeholder="Enter Customer ID" name="CustomerID" value="<?php echo $CustomerID ?>" required readonly>
        </div>

        <div class="form-group">
            <label for="CustomerName">Customer Name</label>
            <input type="text" class="form-control" id="CustomerName" placeholder="Enter Customer Name" name="CustomerName" value="<?php echo $CustomerName ?>" required>
        </div>

        <div class="form-group">
            <label for="CustomerPhone">Customer Phone #</label>
            <input type="text" class="form-control" id="CustomerPhone" placeholder="Enter Customer Phone Number" name="CustomerPhone" value="<?php echo $CustomerPhone ?>" required>
        </div>

        <div class="form-group">
            <label for="role">MemeberShip type</label>
            <select id="inputState" class="form-control" name="mtype" value="<?php echo $Memebership ?>" required>
                <option selected value="1">Basic (1)</option>
                <option value="2">Regular (2)</option>
                <option value="3">Premium (3)</option>
            </select>
        </div>

        <div class="form-group">
            <label for="ExpiryDate">Expiry Date</label>
            <input type="date" class="form-control" id="CustomerPhone" name="expiry" value="<?php echo $Expiry ?>" required>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
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
                window.location.href = '/WebProject/admin/Customers.php';

            }
        </script>

        <?php
        include_once("Footer.php");
        ?>