<div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean">
        <div class="container"><a class="navbar-brand" href="#">Inventory Management&nbsp;</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Inventory
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" id="1" href="index.php" style="color: #222323;">View Inventory</a>
                            <a class="dropdown-item" id="2" href="AddProduct.php" style="color: #222323;">Add Products</a>
                        </div>
                    </li>
                    <li class="nav-item" role="presentation"><a class="nav-link" id="6" href="#">Generate Report</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" id="7" href="Customers.php">View Customers</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" id="4" href="Manage.php">Manage Users</a></li>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link" id="5" data-toggle="dropdown" aria-expanded="false" href="#">My Account</a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="<?php
                                                                                session_destroy();
                                                                                echo "/WebProject/";
                                                                                ?>">Log out</a></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>