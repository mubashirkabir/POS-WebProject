<?php
    require_once("../config.php");
    
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }

        $search  = $_POST["s"];
        $sql = "SELECT * FROM products WHERE  ProductId like '%$search%' or ProductName like '%$search%'";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<a href = "/WebProject/admin/Update?id='.$row['ProductId'].'" style="color: #898a8c;">'. $row['ProductName'] . '</a><br/>';
        }

    ?>
