<?php

include("../../private/config.php");

$products = getAllFetch('products') ? getAllFetch('products')->num_rows : "0";
$sales = getAllFetch('sales') ? getAllFetch('sales')->num_rows : "0";
$orders = getAllFetch('orders') ? getAllFetch('orders')->num_rows : "0";
$newstocks = getAllFetch('newstocks') ? getAllFetch('newstocks')->num_rows : "0";
$productslogs = getAllFetch('productslogs') ? getAllFetch('productslogs')->num_rows : "0";
$categories = getAllFetch('categories') ? getAllFetch('categories')->num_rows : "0";
$suppliers = getAllFetch('suppliers') ? getAllFetch('suppliers')->num_rows : "0";
$accounts = getAllFetch('accounts') ? getAllFetch('accounts')->num_rows : "0";
?>

<div class="row d-flex justify-content-center">
    <!-- Products -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 light-blue lighten-2">
        <div class="card-body ">
            <h4 class="card-title white-text"><i class="fas fa-shopping-cart"></i> Products <?php echo $products ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- Sales -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 cyan lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="fas fa-chart-bar"></i> Sales <?php echo $sales ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- Orders -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 light-blue teal lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="fas fa-chart-bar"></i> Orders <?php echo $orders ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- Accounts -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 deep-purple lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="far fa-user-circle"></i> Accounts <?php echo $accounts ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- Categories -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 indigo lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="far fa-hand-pointer"></i> Categories <?php echo $categories ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- Suppliers -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 blue lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="fas fa-truck"></i> Suppliers <?php echo $suppliers ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- Product Logs -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2 pink lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="fas fa-truck-loading"></i> Products Logs <?php echo $productslogs ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
    <!-- New Stock Logs -->
    <div class="card  col-5 col-xl-3 col-md-4 col-sm-5 m-2  red lighten-2">
        <div class="card-body">
            <h4 class="card-title white-text"><i class="fas fa-truck-loading"></i> Newstocks Logs <?php echo $newstocks ?></h4>
            <hr>
            <p class="card-text white-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Saepe, voluptatem ipsam! Dicta consectetur.</p>
        </div>
    </div>
</div>