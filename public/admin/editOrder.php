<?php
include("./layouts/header.php");

#TODO responsive category and suppliers id overlaps in responsive view

$_SESSION['id'];
if (isset($_POST['s']) && $_POST['s'] == 1) {

    if (noEmptyField($_POST['orderState'])) {

        $orderState = sanitizeInput($_POST['orderState']);
        $orderState = (int)$orderState[0];
        if ($orderState <= 4 && $orderState >= 1) {
            //make changes
            if ($sql = isPrep("UPDATE orders SET state=?, accountID=? WHERE id=?")) {
                $sql->bind_param("sss", $orderState, $_SESSION['accountID'], $_SESSION['id']);
                if (isExecute($sql)) {
                    $_SESSION['msg'] = success("Order ID: " . $_SESSION['id'] . " Successfully Updated");
                    header("location:viewOrders.php");
                }
            }
        } else {
            echo $error("Please Select Only on the Given Order State");
        }
    }
}
if (validateParamID('orderID')) {
    $_SESSION['id'] = (int)$_GET['orderID'];
?>


    <div class="container mt-5">
        <!-- Material form register -->
        <div class="row">
        </div>
        <div class=" card">

            <h5 class="card-header info-color white-text text-center py-4">
                <strong>Edit Order State</strong>
            </h5>

            <!--Card content-->
            <div class="card-body px-lg-5 pt-0">

                <!-- Form -->
                <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <div class="form-row">
                        <div class="col-12">
                            <div class="md-form">
                                <select class=" p-2 col-6" name="orderState[]" required>
                                    <option value="1">Done</option>
                                    <option value="2">Processing</option>
                                    <option value="3">Pending</option>
                                    <option value="4">Cancelled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="s" value="1">Submit</button>


                    <hr>

                </form>
                <!-- Form -->

            </div>

        </div>
        <!-- Material form register -->
    </div>

<?php
} else {
    echo error("Order not Found, Sorry");
}

include("./layouts/footer.php"); ?>