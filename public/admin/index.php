<?php
include("./layouts/header.php");
if (validateParamID('logout')) {
    unset($_SESSION['accountID'], $_SESSION['accountType']);
    header("location:../index.php");
}
?>
<h1>Admin Page</h1>
<?php
// include("./layouts/modal.php");
include("./layouts/footer.php");
?>