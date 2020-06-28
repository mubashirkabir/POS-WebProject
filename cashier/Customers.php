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
                        url: "CustomerSearchBack.php",
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


    session_start();
    echo $_SESSION['userName'];
    if (!(isset($_SESSION['userName']))) {
        echo $_SESSION['userName'];

        //header("Location: /WebProject");
    }

    if (!($_SESSION['userName'] == 'cashier')) {
        //header("Location: /WebProject");
        echo $_SESSION['userName'];

    }
    echo $_SESSION['userName'];


    $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    if (mysqli_connect_error()) {
        die(mysqli_connect_error());
    }

    $sql = "SELECT * FROM customers";
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
            <div id="suggest" style="display: none; color: #898a8c; width: 70%;"> </div>
        </form>
    </nav>
    <div class="table-responsive" style="margin: 0; margin-top: 40px; width: 90%;margin-left: 5%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone #</th>
                    <th>MemeberShip type</th>
                    <th>Description</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr data-href='<?php
                                    echo "/WebProject/admin/CustomerEdit.php?id=" . $row["CustomerId"];
                                    ?>'>
                        <td>
                            <?php
                            echo $row['CustomerId'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['CustomerName'];
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['CustomerPh'];
                            ?>
                        </td>
                        <td>
                            <?php
                            $membership;
                            if ($row['CustomerMembership'] == 1) {
                                $membership = "Basic";
                            } else if ($row['CustomerMembership'] == 2) {
                                $membership = "Regular";
                            } else {
                                $membership = "Premium";
                            }
                            echo   $membership . "&nbsp &nbsp ("   . $row['CustomerMembership'] . ")";
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $row['MembershipExpiry'];
                            ?>
                        </td>
                        <td>
                            <a href="Customerdelete.php?id=<?php echo $row['CustomerId'] ?>">
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
        document.getElementById("1").className = 'nav-link';
        document.getElementById("5").className = 'nav-link';
        document.getElementById("6").className = 'nav-link';
        document.getElementById("7").className = 'nav-link active';

        document.addEventListener("DOMContentLoaded", () => {
            const rows = document.querySelectorAll("tr[data-href]");

            rows.forEach(row => {
                row.addEventListener("click", () => {
                    window.location.href = row.dataset.href;
                });
            });
        });
        document.getElementById("cbtn").attachEvent('onclick', function() {
            window.location.href = '/WebProject/admin/Customers.php';
        });

        function add() {
            document.getElementById("addForm").style.display = "block";
        }

        function cancel() {
            document.getElementById("addForm").style.display = "none";
        }
    </script>

    <?php
    include_once("Footer.php");
    ?>