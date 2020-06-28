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
                    $('#suggest').html("");
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
            
            $('#cid').blur(function() {
                if (!$(this).val()) {
                    $('#suggestcustomer').html("");
                    $('#suggestcustomer').hide();


                }
            });

            $('#cid').keyup(function() {
                if ($('this').val() == "") {
                    $('#suggestcustomer').hide();
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
                            $('#suggestcustomer').show();
                            $('#suggestcustomer').html(data);

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
        header("Location: /WebProject");
    }

    if (!($_SESSION['userName'] == 'cashier')) {
        header("Location: /WebProject");
    }



    ?>

</head>

<body>
    <?php
    include_once("Header.php");
    ?>

    <nav class="navbar navbar-light bg-light">
        <form class="form-inline" style="width: 40%; margin-left: 30%; margin-top: 80px; ">
            <input class="form-control mr-sm-2" type="search" placeholder="Search Now" aria-label="Search" id="searchbar" style="width: 80%;">
            <div id="suggest" style="display: none; color: #898a8c; width: 70%;"> </div>
        </form>
    </nav>
    
    <div style="float: right; width: 300px; margin-right: 20px;">
        <h1 class="display-4" style="font-size: 35px;">Grand total</h1>
        <input type="text" class="form-control" id="gtotal" style="width: 200px; margin-bottom: 10px;" value="0" readonly>
    </div>

    <div style="float: left; width: 300px; margin-left: 95px;">
        <h1 class="display-4" style="font-size: 35px;">Customer</h1>
        <input type="text" class="form-control" id="cid" style="width: 300px;" placeholder="Enter Customer Id or Name">
        <div id="suggestcustomer" style="display: none; color: #898a8c; margin-bottom: 15px;"> </div>
    </div>

    <div class="table-responsive" style="margin: 0; margin-top: 40px; width: 90%;margin-left: 5%;">
        <table class="table table-bordered" id="mainTable">
            <thead>
                <tr>
                    <th style="width: 70px;">ID</th>
                    <th style="width: 320px;">Name</th>
                    <th style="width: 74px;">Quantity</th>
                    <th style="width: 120px;">Price</th>
                    <th style="width: 60px;"> </th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>

    <script>
        function gettable(pid) {
            $.ajax({
                url: 'sendProductDetail.php',
                type: 'POST',
                data: {
                    s: pid
                },
                success: function(data) {
                    var obj = JSON.parse(data);
                    $('#mainTable tbody')
                        .append("<tr><td>" + obj.ProductID + "</td><td>" + obj.ProductName + "</td><td > <input type='text'  id='quantityinput' value= '1' style='background: #f7f9fc; padding: 2px;'> <input type='button' id = 'update' value='Update' onclick='updateprice(p" + obj.ProductPrice + ")'></td><td class = 'pprice' id = 'p" + obj.ProductPrice + "'>" + obj.ProductPrice + "</td><td><input id = 'del' type='button' value='Remove' onclick='SomeDeleteRowFunction(this, p" + obj.ProductPrice + ")'></td></tr>");
                    var temp = parseFloat($('#gtotal').val());
                    var temp2 = parseFloat(obj.ProductPrice);
                    $('#gtotal').val(temp + temp2);
                },
                error: function() {
                    console.log('error');
                }
            });
        }

        function SomeDeleteRowFunction(o, pid) {
            var p = o.parentNode.parentNode;
            var pricerow = parseFloat($(pid).text());
            var gtotalrow = parseFloat($('#gtotal').val());
            console.log(pricerow);
            console.log(gtotalrow);
            $('#gtotal').val(gtotalrow - pricerow);
            p.parentNode.removeChild(p);
        }

        function updateprice(pid) {
            var price = parseFloat($("#update").parent().siblings('.pprice').text());
            var gtotal = parseFloat($('#gtotal').val());
            var quan = parseInt($('#quantityinput').val());
            $(pid).html(quan * price);
            $('#gtotal').val(gtotal - price);
            gtotal = parseFloat($('#gtotal').val());
            $('#gtotal').val(gtotal + (quan * price));
        }

        function getcustomer(membership) {
            if (parseInt(membership) == 1) {
                var gtotal = parseFloat($('#gtotal').val());
                $('#gtotal').val(parseInt(gtotal * 0.95));
            } else if (parseInt(membership) == 2) {
                var gtotal = parseFloat($('#gtotal').val());
                $('#gtotal').val(parseInt(gtotal * 0.9));
            } else {
                var gtotal = parseFloat($('#gtotal').val());
                $('#gtotal').val(parseInt(gtotal * 0.80));
            }
        }
    </script>

    <?php
    include_once("Footer.php");
    ?>