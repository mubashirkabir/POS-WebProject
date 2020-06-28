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
    
    // if (!isset($_SESSION)) {
    //     session_start();
    // }
    // if (!(isset($_SESSION['userName']))) {

    //     header("Location: /WebProject");
    // }

    // if (!($_SESSION['userName'] == 'admin')) {
    //     header("Location: /WebProject");
    // }


    $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    if (mysqli_connect_error()) {
        die(mysqli_connect_error());
    }

    $sql = "SELECT * FROM products";
    $result = mysqli_query($connection, $sql);

    ?>

</head>

<body>
    <?php
    include_once("Header.php");
    ?>

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline" style="width: 40%; margin-left: 30%; margin-top: 80px; ">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Now" aria-label="Search" id="searchbar" style="width: 70%;">
            <div id="suggest" style="display: none; color: #898a8c;"> </div>
        </form>
    </nav>

    <div class="table-responsive" style="margin: 0; margin-top: 40px; width: 90%;margin-left: 5%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width: 60px;">ProductID</th>
                    <th style="width: 220;">ProductName</th>
                    <th style="width: 100px;">Price</th>
                    <th style="width: 74px;">Quantity</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr data-href='<?php
                                    echo "/WebProject/admin/Update?id=" . $row["ProductId"];
                                    ?>'>
                        <td>
                            <?php
                            echo $row['ProductId'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['ProductName'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['ProductPrice'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['ProductQuantity'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['ProductDescription'];
                            ?>
                        </td>
                        <td>
                            <a href="deleteProduct.php?id=<?php echo $row['ProductId'] ?>">
                                <button type="button" id="cbtn" class="btn btn-primary" onclick='return confirm("Are you sure you want to delete this?");'>Delete</button>
                            </a>
                        </td>
                    </tr>
                <?php
            }
            ?>



            </tbody>
        </table>
    </div>

    <script>
        document.getElementById("2").className = 'nav-link';
        document.getElementById("4").className = 'nav-link';
        document.getElementById("1").className = 'nav-link active';
        document.getElementById("5").className = 'nav-link';
        document.getElementById("6").className = 'nav-link';
        document.getElementById("7").className = 'nav-link';

        document.addEventListener("DOMContentLoaded", () => {
            const rows = document.querySelectorAll("tr[data-href]");

            rows.forEach(row => {
                row.addEventListener("click", () => {
                    window.location.href = row.dataset.href;
                });
            });
        });
        document.getElementById("cbtn").attachEvent('onclick', function() {
            window.location.href = '/WebProject/admin';
        });
    </script>

    <?php
    include_once("Footer.php");
    ?>