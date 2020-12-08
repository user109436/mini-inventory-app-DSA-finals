<?php
include("./layouts/header.php");
pageRestrict();

// $_SESSION['date'];
if (isset($_POST['s']) && $_POST['s'] == 1) {
    $date = strip_tags($_POST['orderState'][1]);
    $orderState = sanitizeInput($_POST['orderState']);
    if (noEmptyField($_POST['orderState'])) {

        $orderState[0] = (int)$orderState[0];
        $orderState[1] = (int)$orderState[1];
        if ($orderState[0] <= 4 && $orderState[0] >= 1) {

            //return qty to sales and products if cancelled
            $msg = $orderState[0] == 4 ? returnQtySaleProd($date) : "";

            //make changes to orders
            if ($sql = isPrep("UPDATE orders SET state=?, accountID=? WHERE date=?")) {
                $sql->bind_param("sss", $orderState[0], $_SESSION['accountID'], $date);
                if (isExecute($sql)) {
                    $_SESSION['msg'] = success("Date Order: " . $date . " Successfully Updated" . $msg);
                    header("location:viewOrders.php");
                }
            }
        } else {
            echo error("Please Select Only on the Given Order State");
        }
    }
}
if (isset($_GET['orderID']) and !empty($_GET['orderID'])) {
    $date = $_GET['orderID'];

    if ($orderState = isPrep("SELECT * from orders WHERE date=?")) {
        $orderState->bind_param("s", $date);
        if (isExecute($orderState)) {
            $result = $orderState->get_result();
            $currentState = $result->fetch_assoc()['state'];
        }
    }

    if ($currentState == 3 || $currentState == 2) { // allow edit only if processing and to review

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
                                    <select class=" p-2 col-6" name="orderState[0]" required>
                                        <option value="1">Done</option>
                                        <option value="2">Processing</option>
                                        <option value="3">To Review</option>
                                        <option value="4">Cancelled</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" value="<?php echo $date; ?>" name="orderState[1]">
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
        $_SESSION['msg'] = warning("Order Transaction: " . $_GET['orderID'] . " cannot edit a finish or cancelled transaction");
        header("location:viewOrders.php");
    }
} else {
    echo error("Order not Found, Sorry");
}

include("./layouts/footer.php"); ?>