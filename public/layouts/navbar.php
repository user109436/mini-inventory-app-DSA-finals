<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark indigo scrolling-navbar">
    <!-- <nav class="navbar  navbar-dark scrolling-navbar"> -->

    <div class="container">

        <!-- Brand -->
        <a class="navbar-brand" href="./home.php">
            <strong>INVETOTRACK</strong>
        </a>

        <!-- Collapse -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left -->
            <?php

            if (isset($_SESSION['accountID']) and $_SESSION['accountType'] == 1) {
            ?>
                <ul class="navbar-nav mr-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="./orders.php">Orders
                        </a>
                    </li>
                </ul>

            <?php
            }
            ?>
            <?php


            if (isset($_SESSION['accountID']) and $_SESSION['accountType'] == 1) {
            ?>
                <ul class="navbar-nav ml-auto nav-flex-icons">
                    <li class="nav-item">
                        <a class="nav-link waves-effect waves-light">
                            <span class="badge badge-pill badge-secondary">Upcoming <i class="fas fa-envelope"></i> </span>
                        </a>
                    </li>
                    <li class="nav-item avatar dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
                            <a class="dropdown-item" href="home.php?logout=1">Log Out</a>
                        </div>
                    </li>
                </ul>
            <?php
            }

            ?>

        </div>

    </div>
</nav>
<!-- Navbar -->