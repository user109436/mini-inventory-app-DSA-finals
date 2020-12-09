<?php
include("./layouts/header.php");
if (validateParamID('logout')) {
    unset($_SESSION['accountID'], $_SESSION['accountType']);
    header("location:../index.php");
}

?>
<div style="height:100vh; background-image: url(../node_modules/mdbootstrap/img/dashboard.svg); background-repeat: no-repeat; background-size: cover;">
    <div class=" container">

    </div>
</div>
<?php
include("./layouts/footer.php");
?>
<script>
    $(document).ready(function() {
        var index = 0;
        setInterval(function() {
            $('.container').load('dashboard.php ');
            index = index + 1;
            console.log(index + ' update');
        }, 5000);
    });
</script>