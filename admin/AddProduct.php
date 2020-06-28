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
    <!-- 
    <script>
        $().ready(function() {
            $('#success').hide();
            $('#failed').hide();
            $("button").click(function() {
                $.ajax({
                    url: "/WebProject/admin/AddProductAction.php",
                    method: "POST",
                    data: {
                        pid = $('#ProductID').val();
                        pname = $('#ProductName').val();
                        pprice = $('#Price').val();
                        pquality = $('#Quantity').val();
                        pdes = $('#ProductDescription').val();
                    },
                    dataType: "text",
                    success: function(code) {
                        if (code = true) {
                            $('#success').show();
                        } else {
                            $('#failed').show();

                        }
                    },
                    error: function(code) {
                        $('#failed').show();
                    }
                });
            });
        });
    </script> -->


    <?php
    require_once("../config.php");

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
        $sql = "INSERT INTO `products` (`ProductId`, `ProductName`, `ProductPrice`, `ProductQuantity`, `ProductDescription`) VALUES ('$pid', '$pname', '$pprice', '$pquantity', '$pdes') ";

        $result = mysqli_query($connection, $sql);
        if (mysqli_error($connection)) {
            die("Something went wrong! Check your Database");
            echo ' <div class="alert alert-danger" role="alert" id="success" style="display: none;"> Product not Added! Check your database.</div>';
        }
        mysqli_close($connection);
        echo ' <div class="alert alert-success" role="alert" id="success" style="display: none;"> Product Added Successfully!</div>';
    }
    ?>
</head>

<body>
    <?php
    include_once("Header.php");
    function showsuc()
    {
        echo ' <div class="alert alert-success" role="alert" id="success" style="display: none;"> Product Added Successfully!</div>';
    }
    function showsfail()
    {
        echo ' <div class="alert alert-danger" role="alert" id="success" style="display: none;"> Product not Added! Check your database.</div>';
    }
    ?>
    <form id="addProductForm" style="width: 40%; margin-left: 30%; margin-right: 30%; padding: 18px; margin-top: 50px;" method="post">
        <div class="form-group">
            <label for="ProductID">Product ID</label>
            <input type="text" class="form-control" id="ID" name="ProductID" placeholder="Enter Product ID" required>
        </div>
        <div class="form-group">
            <label for="ProductName">Product Name</label>
            <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Enter Product Name" required>
        </div>
        <div class="row">
            <div class="col">
                <label for="Price">Price</label>
                <input type="text" class="form-control" placeholder="Enter Price" name="Price" required>
            </div>
            <div class="col">
                <label for="Quantity">Quantity</label>
                <input type="text" class="form-control" placeholder="Enter Quantity" name="Quantity" required>
            </div>
        </div>
        <br />
        <div class="form-group">
            <label for="ProductDescription">Product Description</label>
            <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" placeholder="Product Description">
        </div>
        <center>
            <button type="submit" class="btn btn-primary" id="sub" style="padding-left: 50px; padding-right: 50px;">Submit</button>
        </center>
    </form>


    <script>
        document.getElementById("1").className = 'nav-link';
        document.getElementById("2").className = 'nav-link active';
        document.getElementById("3").className = 'nav-link';
        document.getElementById("4").className = 'nav-link';
        document.getElementById("5").className = 'nav-link';
        document.getElementById("6").className = 'nav-link';
        document.getElementById("7").className = 'nav-link';
    </script>


    <?php
    include_once("Footer.php");
    ?>