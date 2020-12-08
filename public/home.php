<?php
include("./layouts/header.php");
if (!isset($_SESSION['accountID']) or !isset($_SESSION['accountType'])) {
    header("location:./");
}

if (isset($_GET['logout']) and $_GET['logout'] == 1) {
    unset($_SESSION['accountID'], $_SESSION['accountType']);
    header("location:./");
}
//users can order one at  a time
?>
<!-- Full Page Intro -->
<div class="view full-page-intro" style=" background-image: url( node_modules/mdbootstrap/img/home.svg); background-repeat: no-repeat; background-size: cover;">
    <!-- Content -->
    <div class="container-fluid mt-5">
        <?php include("card.php"); ?>
    </div>
</div>
<!-- Content -->
<!-- Mask & flexbox options-->
<div class="mask rgba-black-light d-flex justify-content-center align-items-center">




</div>
<!-- Mask & flexbox options-->

</div>
<!-- Full Page Intro -->

<?php
include("./layouts/footer.php");
?>
<script>
    var index = 0;
</script>