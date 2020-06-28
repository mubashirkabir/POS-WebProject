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
    
    // session_start();
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

    $sql = "SELECT * FROM users";
    $result = mysqli_query($connection, $sql);


    // if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //     $connection1 = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
    //     if (mysqli_connect_error()) {
    //         die(mysqli_connect_error());
    //     }
    //     $fullname = $_POST["FullName"];
    //     $username  = $_POST["UserName"];
    //     $password = md5($_POST["UserPassword"]);
    //     $role = $_POST["role"];

    //     $sql1 = "INSERT INTO users ( `FullName`, `UserName`, `UserPassword`, `UserRole`) VALUES ( $fullname ,$username , $password, $role)";
    //     $result = mysqli_query($connection1, $sql1);
    //     if (mysqli_error($connection1)) {
    //         die("Something went wrong! Check your Database");
    //     }
    //     mysqli_close($connection1);
    //     echo '<script type="text/javascript">',
    //         'cancel();',
    //         '</script>';
    // }


    ?>

</head>

<body>

    <?php
    include_once("Header.php");
    ?>

    <button id="mainButton" onclick="add()" class="btn btn-primary" type="button" style="width: 150px; text-align: center; margin-left: 70%; margin-right: 30%; margin-top: 60px; color: white; background: #898a8c;">Add new user</button>
    <form method="post" action="AddUser.php" id="addForm" class="border border-secondary" style=" padding: 15px; margin-top: 30px; width: 60%; margin-left: 20%; display:none;">

        <div class="form-group">
            <label for="UserFullName">Full Name</label>
            <input type="text" class="form-control" id="FullName" placeholder="Enter Full Name" name="FullName">
        </div>

        <div class="form-group">
            <label for="UserName">User Name</label>
            <input type="text" class="form-control" id="Username" placeholder="Enter User Name" name="UserName">
        </div>

        <div class="form-group">
            <label for="UserPassword">User Password</label>
            <input type="password" class="form-control" id="UserPassword" placeholder="Enter User Password" name="UserPassword">
        </div>

        <div class="form-group">
            <label for="role">Select User Role</label>
            <select id="inputState" class="form-control" name="role">
                <option value="1">Admin (1)</option>
                <option selected value="2">Cashier (2)</option>
            </select>
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
        <button onclick="cancel()" type="button" class="btn btn-primary">Cancel</button>
    </form>

    <div class="table-responsive" style="margin-top: 30px; width: 60%; margin-left: 20%;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th style="width: 15%;">Full Name</th>
                    <th style="width: 15%;">User Name</th>
                    <th style="width: 15%;">User Role</th>
                    <th colspan="2" style="width: 15%;">Edit/Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td>
                            <?php
                            echo $row['FullName'];
                            ?>
                        </td>
                        <td>

                            <?php
                            echo $row['UserName'];
                            ?>

                        </td>
                        <td>

                            <?php
                            $role;
                            if ($row['UserRole'] == 1) {
                                $role = "Admin";
                            } else if ($row['UserRole'] == 2) {
                                $role = "Cashier";
                            }
                            echo   $role . "&nbsp &nbsp ("   . $row['UserRole'] . ")";
                            ?>

                        </td>
                        <td>
                            <a href="UpdateUser.php?id=<?= $row['Id'] ?>">
                                <button type="button" class="btn btn-primary">Edit</button>
                            </a>
                        </td>
                        <td>
                            <a href="deleteUser.php?id=<?= $row['Id'] ?>">
                                <button type="button" class="btn btn-primary">Delete</button>
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
        document.getElementById("1").className = 'nav-link';
        document.getElementById("2").className = 'nav-link';
        document.getElementById("4").className = 'nav-link active';
        document.getElementById("5").className = 'nav-link';
        document.getElementById("6").className = 'nav-link';
        document.getElementById("7").className = 'nav-link';

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