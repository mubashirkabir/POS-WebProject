<?php
    require_once("../config.php");

    
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }

        $search  = $_POST["s"];
        $sql = "SELECT * FROM customers WHERE  CustomerId like '%$search%' or CustomerName like '%$search%'";
        $result = mysqli_query($connection, $sql);
        while($row = mysqli_fetch_assoc($result))
        {

            echo '<a  href="#"  style="color: #898a8c;" onclick="getcustomer('.$row["CustomerMembership"].')">'. $row['CustomerName'] . '</a><br/>';
        }
?>