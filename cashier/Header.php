<div>
    <nav class="navbar navbar-light navbar-expand-md navigation-clean">
        <div class="container"><a class="navbar-brand" href="#">Inventory Management&nbsp;</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item" role="presentation"><a class="nav-link" id="6" href="index.php">Home</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" id="7" href="Customers.php">View Customers</a></li>
                    <li class="dropdown nav-item"><a class="dropdown-toggle nav-link" id="5" data-toggle="dropdown" aria-expanded="false" href="#">My Account</a>
                        <div class="dropdown-menu" role="menu">
                            <a class="dropdown-item" role="presentation" href="#">User Setting</a>
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