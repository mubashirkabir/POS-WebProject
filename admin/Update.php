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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(e) {

            $('#searchbar').blur(function() {
                if (!$(this).val()) {
                    $('#suggest').hide();


                }
            });

            $('#searchbar').keyup(function() {
                if ($('this').val() == "") {
                    $('#suggest').hide();
                    return;
                } else {
                    var val = $(this).val();
                    $.ajax({
                        url: "SearchBack.php",
                        method: "POST",
                        data: {
                            s: val
                        },
                        success: function(data) {
                            $('#suggest').show();
                            $('#suggest').html(data);
                        }
                    });
                }
            });
        });
    </script>


    <?php
    require_once("../config.php");
    $pid = $pname = $pprice = $pquantity = $pdes = "";
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

        $pid  = $_GET["id"];
        $sql = "SELECT * FROM products WHERE  ProductId = '$pid'";
        $result = mysqli_query($connection, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $pname = $row['ProductName'];
            $pprice = $row['ProductPrice'];
            $pquantity = $row['ProductQuantity'];
            $pdes = $row['ProductDescription'];
        }
    }

    // if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //     $pid = $_POST["ProductID"];
    //     $pname  = $_POST["ProductName"];
    //     $pprice = $_POST["Price"];
    //     $pquantity = $_POST["Quantity"];
    //     $pdes = $_POST["ProductDescription"];

    //     $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    //     if (mysqli_connect_error()) {
    //         die(mysqli_connect_error());
    //     }

    //     $sql = "UPDATE `products` SET `ProductId` = '$pid', `ProductName` = '$pname', `ProductPrice` = '$pprice', `ProductQuantity` = '$pquantity', `ProductDescription` = '$pdes' WHERE `ProductId` = '$pid'";
    //     $result = mysqli_query($connection, $sql);
    //     if (mysqli_error($connection)) {
    //         die("Error, Something wrong with your database. ");
    //     }
    //     mysqli_close($connection);
    // }


    // if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //     if (isset($_GET["id"])) {
    //         echo $_GET["id"];
    //         echo "<script type='text/javascript'>showForm();</script>";
    //         $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    //         if (mysqli_connect_error()) {
    //             die(mysqli_connect_error());
    //         }

    //         $pid  = $_GET["id"];
    //         $sql = "SELECT * FROM products WHERE  ProductId = '$pid'";
    //         $result = mysqli_query($connection, $sql);
    //         while ($row = mysqli_fetch_assoc($result)) {
    //             $pname = $row['ProductName'];
    //             $pprice = $row['ProductPrice'];
    //             $pquantity = $row['ProductQuantity'];
    //             $pdes = $row['ProductDescription'];
    //         }
    //     }
    // }
    ?>

</head>

<body>
    <?php
    include_once("Header.php");
    ?>


    <form id="mainForm" style="width: 40%; margin-left: 30%; margin-right: 30%; padding: 18px; margin-top: 50px;" method="post" action="\WebProject\admin\UpdateProductAction.php">
        <div class="form-group">
            <label for="ProductID">Product ID</label>
            <input type="text" class="form-control" id="ID" name="ProductID" placeholder="Enter Product ID" value="<?php echo $pid ?>" required>
        </div>
        <div class="form-group">
            <label for="ProductName">Product Name</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter Product Name" value="<?php echo $pname ?>" required>
        </div>
        <div class="row">
            <div class="col">
                <label for="Price">Price</label>
                <input type="text" class="form-control" placeholder="Enter Price" name="Price" value="<?php echo $pprice ?>" required>
            </div>
            <div class="col">
                <label for="Quantity">Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Quantity" name="Quantity" value="<?php echo  $pquantity ?>" required>
            </div>
        </div>
        <br />
        <div class="form-group">
            <label for="ProductDescription">Product Description</label>
            <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" value="<?php echo $pdes ?>" placeholder="Product Description">
        </div>
        <button type="submit" class="btn btn-primary" id="sub" style="padding-left: 50px; padding-right: 50px; margin-right: 10px;">Update</button>
        <button type="button" class="btn btn-primary" style="padding-left: 50px; padding-right: 50px;" onclick=' return window.location.href = "index.php";'>Cancel</button>

    </form>

    <script>
        document.getElementById("1").className = 'nav-link';
        document.getElementById("2").className = 'nav-link';
        document.getElementById("4").className = 'nav-link';
        document.getElementById("3").className = 'nav-link active';
        document.getElementById("5").className = 'nav-link';
        document.getElementById("6").className = 'nav-link';
        document.getElementById("7").className = 'nav-link';
    </script>

    <?php
    include_once("Footer.php");
    ?>