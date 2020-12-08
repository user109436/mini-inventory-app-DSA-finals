<?php
include("./layouts/header.php");
if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType']  == 1) {
    header("location:home.php");
} else if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType']  >= 2) {
    header("location:admin");
}
?>

<body>
    <!-- Full Page Intro -->
    <div class="view full-page-intro" style="height:100vh; background-image: url( node_modules/mdbootstrap/img/pwd.svg); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="container">

                <!--Grid row-->
                <div class="row d-flex justify-content-center">

                    <!--Grid column-->
                    <div class="col-md-12 col-xl-5 mb-4 ">
                        <!--Card-->
                        <h2 class="White-text font-weight-bold">Account Recovery Upcoming</h2>


                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

            </div>
            <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

    </div>
    <!-- Full Page Intro -->
</body>
<script>
    function showPwd() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php

include("./layouts/footer.php");
?>