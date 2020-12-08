<!--Navbar-->
<nav class="navbar navbar-expand-lg navbar-dark primary-color">

    <!-- Navbar brand -->
    <a class="navbar-brand" href="./">ABC &#169;</a>

    <!-- Collapse button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#abcNav" aria-controls="abcNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Collapsible content -->
    <div class="collapse navbar-collapse" id="abcNav">

        <!-- Links -->
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="./"><i class="fas fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./viewProducts.php"><i class="fas fa-shopping-cart"></i> Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./viewSales.php"><i class="fas fa-chart-bar"></i> Sales</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./viewOrders.php"><i class="fas fa-chart-bar"></i> Orders</a>
            </li>

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-chevron-circle-down"></i> More</a>
                <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                    <a class="dropdown-item blue-text" href="./viewStocks.php"><i class="fas fa-truck-loading"></i> Newstocks Logs</a>
                    <a class="dropdown-item blue-text" href="./viewProductsLogs.php"><i class="fas fa-truck-loading"></i> Products Logs</a>
                    <a class="dropdown-item blue-text" href="./viewCategories.php"><i class="far fa-hand-pointer"></i> Categories</a>
                    <a class="dropdown-item blue-text" href="./viewSuppliers.php"><i class="fas fa-truck"></i> Suppliers</a>
                    <a class="dropdown-item blue-text" href="./viewAccounts.php"><i class="far fa-user-circle"></i> Accounts</a>
                </div>
            </li>

        </ul>
        <ul class="navbar-nav ml-auto nav-flex-icons">
            <li class="nav-item">
                <a class="nav-link waves-effect waves-light">
                    <span class="badge badge-pill badge-secondary">Upcoming <i class="fas fa-envelope"></i> </span>
                </a>
            </li>
            <li class="nav-item avatar dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink-55" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="far fa-user-circle"></i>
                    <!-- <img src="https://mdbootstrap.com/img/Photos/Avatars/avatar-2.jpg" class="rounded-circle z-depth-0" alt="avatar image"> -->
                </a>
                <div class="dropdown-menu dropdown-menu-lg-right dropdown-secondary" aria-labelledby="navbarDropdownMenuLink-55">
                    <a class="dropdown-item" href="./?logout=1">Log Out</a>
                </div>
            </li>
        </ul>
        <!-- Links -->
    </div>
    <!-- Collapsible content -->

</nav>
<!--/.Navbar-->