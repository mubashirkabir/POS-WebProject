<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>POS</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Login-Form-Clean.css">
    <link rel="stylesheet" href="assets/css/Navigation-Clean.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
        $().ready(function() {
            $('#msg').hide();
            $('#uname').change(function() {
                if ($('#uname').val() == "") {
                    return;
                } else {
                    var username = $(this).val();
                    $.ajax({
                        url: "UserNamecheck.php",
                        method: "POST",
                        data: {
                            u: username
                        },
                        dataType: "text",
                        success: function(code) {
                            if (code == 'true') {
                                $('#msg')
                                    .html('**Correct UserName**')
                                    .css("color", "green")
                                    .css("display", "block");
                            } else if (code == 'false') {
                                $('#msg')
                                    .html('***UserName Not Found***')
                                    .css("color", "red")
                                    .css("display", "block");
                            }
                        },
                        error: function(code) {
                            $('#msg')
                                .html(code);
                            $('#msg').hide();
                        }
                    })
                }
            });

            //     $("#submit").click(function () {
            //         if ($('#uname').val() == "" || $('#upass').val() == "") {
            //             return;
            //         } else {
            //             $.ajax({
            //                 url: "loginaction.php",
            //                 method: "POST",
            //                 data: { u: username, p: pwd },
            //                 dataType: "text",
            //                 success: function (code) {
            //                     if (code == 'true') {
            //                         $('#mainmsg')
            //                             .html("Correct Password")
            //                             .attr('class', 'alert alert-success');
            //                         window.location.href = "/WebProject//Inventory";
            //                     } else if (code == 'false') {
            //                         $('#mainmsg')
            //                             .html("Incorrect Password")
            //                             .attr('class', 'alert alert-danger');
            //                     }
            //                 },
            //                 error: function (code) {
            //                     $('#mainmsg')
            //                         .html(code);
            //                 }

            //             });

            //         }


            //     });
        });
    </script>


    <?php
    require_once("config.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $connection = mysqli_connect(DBHOST, DBUSER, DBPASSWORD, DBNAME);
        if (mysqli_connect_error()) {
            die(mysqli_connect_error());
        }

        $username  = $_POST["username"];
        $password = md5($_POST["password"]);
        $sql = "SELECT * FROM users WHERE  UserName= '$username'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);
        if (!isset($_SESSION)) {
            session_start();
        }

        if ($row['UserPassword'] == $password) {
            if ($row['UserRole'] == 1) {
                $_SESSION['userName'] = 'admin';
                header("Location: /WebProject/admin");
            } else if ($row['UserRole'] == 2) {
                $_SESSION['userName'] = 'cashier';
                header("Location: /WebProject/cashier");
            } else {
                echo "<script type='text/javascript'>alert('Something went wrong !! <br /> try again..');</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Wrong Password');</script>";
        }
    }
    ?>



</head>

<body id="loginBody" style="text-align: center;">

    <div class="text-primary login-clean" id="mainLogin" style=" padding-top: 200px; padding-bottom: 305px;">
        <form method="POST" style="display: inline-block;">
            <h2 class="sr-only">Login Form</h2>

            <div id="mainmsg" style="display: none;"></div>

            <div class="illustration">
                <img src="assets/img/pos.png" alt="Login" width="200" height="150">
            </div>

            <div class="form-group">
                <input class="form-control" type="text" id="uname" name="username" placeholder="User Name">
                <label id="msg" style="display: none;"></label>
            </div>

            <div class="form-group">
                <input class="form-control" type="password" id="upass" name="password" placeholder="Password">
            </div>

            <div class="form-group">
                <button class="btn btn-primary btn-block" type="submit" id="submit">Log In</button>
            </div>

        </form>

    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>