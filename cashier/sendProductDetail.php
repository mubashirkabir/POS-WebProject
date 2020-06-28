<?php
    require_once("../config.php");

    
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }

        $search  = $_POST["s"];
        $sql = "SELECT * FROM products WHERE  ProductId = '$search'";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            $arr = array('ProductID' => $row['ProductId'], 'ProductName' => $row['ProductName'], 'ProductPrice' => $row['ProductPrice']);
            echo json_encode($arr);

        }
?>