<?php
include("./layouts/header.php");
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
if (validateParamID('productID')) {
    deleteById('products', $_GET['productID']);
    // header("location:./");
} else {
    // echo error("Invalid ID for deletion", $_GET['productID']);
}
?>
<div class="table-responsive p-3">
    <?php include("./viewProducts.php"); ?>
</div>
<?php


include("./layouts/footer.php");
?>