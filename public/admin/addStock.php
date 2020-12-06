<?php
include("./layouts/header.php");

// $resultSales = isPrep("UPDATE sales, orders SET sales.listPrice=?, orders.listPrice=? WHERE sales.id=? AND orders.id=?");
// $resultSales->bind_param("ssss", $a, $a, $id, $id);
// $resultSales->execute();
// echo "Update Sales and Orders Affected Rows:" . $resultSales->affected_rows;
// // --products . UPrice + products . percentMargin + 12 % VAT

// die();

if (isset($_POST['s']) && $_POST['s'] == 1) {
    printArr($_POST);

    if (noEmptyField($_POST['products'])) {


        if (noEmptyField($_POST['products'])) {
            $productInfo = sanitizeInput($_POST['products']);
            /*
                0-product id
                1-qty
                2-UPrice
             */
            if ($sql = getById(
                'products',
                $productInfo[0],
                1,
                "Cannot Add Stocks To Non-Existing Product"
            )) {

                $msg = null;
                //insert into new stocks for logging purposes
                if ($newstock = isPrep("INSERT INTO newstocks (id, qty, UPrice, accountID) VALUES (?,?,?,?)")) {
                    $newstock->bind_param("ssss", $productInfo[0], $productInfo[1], $productInfo[2], $_SESSION['accountID']);
                    if (isExecute($newstock)) {
                        $msg .= "Record Saved to Logs ";
                    }
                }

                $row = $sql->fetch_assoc();
                $percentMargin = $row['percentMargin'] / 100;
                $qty = $row['qtyOnHand'];
                $listPrice = $productInfo[2] + ($productInfo[2] * $percentMargin);
                $listPrice += $listPrice * .12;
                $listPrice = round($listPrice, 2);
                $qty += $productInfo[1];

                //update products
                $msg .= "Changes, ";
                if ($sql = isPrep("UPDATE products SET qtyOnHand=?, UPrice=? WHERE id=?")) {
                    $sql->bind_param("sss", $qty, $productInfo[2], $productInfo[0]);
                    if (isExecute($sql)) {
                        $msg .= $sql->affected_rows . "  in Products, ";
                        //insert the updated prouducts
                        if ($sql = getById('products', $productInfo[0])) {
                            logProduct($sql->fetch_all()[0], $_SESSION['accountID'], 2);
                        }
                    }
                }
                //update sales
                if ($sql = isPrep("UPDATE sales SET qty=?, listPrice=? WHERE id=?")) {
                    $sql->bind_param("sss", $qty, $listPrice, $productInfo[0]);
                    if (isExecute($sql)) {
                        $msg .= $sql->affected_rows . " in Sales, ";
                    }
                }
                //update orders
                if ($sql = isPrep("UPDATE orders SET listPrice=? WHERE id=?")) {
                    $sql->bind_param("ss", $listPrice, $productInfo[0]);
                    if (isExecute($sql)) {
                        $msg .= $sql->affected_rows . " in Orders ";
                    }
                }
                $_SESSION['msg'] = success($msg);
                header("location:viewProducts.php");
            }
        }
    }
}
?>

<div class="container mt-5">
    <!-- Material form register -->
    <div class="row">
    </div>
    <div class=" card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Add Stocks</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="form-row">
                    <div class="col-12">
                        <div class="md-form">
                            <select class=" p-2 col-6" name="products[]" require="true">
                                <?php
                                if ($result = getAllFetch("products")) {
                                    if ($result->num_rows > 0) {
                                        echo '<option value="" disabled selected>Choose Products</option>';
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo '<option value="" disabled selected>Please Add First a Product</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="col-12 d-flex  flex-column ">
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo isset($_POST['products'][1]) ? $_POST['products'][1] : "" ?>" require="true" type="number" class="form-control" name="products[1]">
                                <label for="qtyOnHand">Quantity</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo isset($_POST['products'][2]) ? $_POST['products'][2] : "" ?>" require="true" step="any" type="number" class="form-control" name="products[2]">
                                <label for="UPrice">UPrice($)</label>
                            </div>
                        </div>
                        <div>
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
<script type="text/javascript">
</script>
<?php
include("./layouts/footer.php"); ?>