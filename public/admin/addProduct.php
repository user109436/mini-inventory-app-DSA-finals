<?php
include("./layouts/header.php");


//check if categories and suppliers is existing
//check if  forsale is yes or no 


if (isset($_POST['s']) && $_POST['s'] == 1) {
    $productInfo = sanitizeInput($_POST['products']); //sanitize values
    if (noEmptyField($_POST['products'])) {
        if ($sql = isPrep("INSERT INTO products (name, catID, supID, forsale, qtyOnHand, UPrice, percentMargin)VALUES(?,?,?,?,?,?,?)")) {
            $sql->bind_param("sssssss", $productInfo[0], $productInfo[1], $productInfo[2], $productInfo[3], $productInfo[4], $productInfo[5], $productInfo[6]);
            if (isExecute($sql)) {
                createEditProduct($conn->insert_id, $productInfo);
                logProduct($productInfo, $_SESSION['id'], 1);
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
            <strong>Add Products</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="form-row">
                    <div class="col-12">
                        <!-- First name -->
                        <div class="md-form">
                            <input value="<?php echo $_POST['products'][0] ?? "" ?>" required type="text" id="productName" class="form-control" name="products[0]">
                            <label for="productName">Name</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="md-form">
                            <select class=" p-2 col-6" name="products[1]" required>
                                <?php
                                if ($result = getAllFetch("categories")) {
                                    if ($result->num_rows > 0) {
                                        echo '<option value="" disabled selected>Choose Category</option>';
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo '<option value="" disabled selected>Please Add First a category</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="md-form">
                            <select class=" p-2 col-6" name="products[2]" required>
                                <?php
                                if ($result = getAllFetch("suppliers")) {
                                    if ($result->num_rows >  0) {

                                        echo '<option value="" disabled selected>Choose Supplier</option>';
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                        }
                                    } else {

                                        echo '<option value="" disabled selected>Please Add First a supplier</option>';
                                    }
                                }
                                ?>

                            </select>
                        </div>
                    </div>
                    <div class="col-12 d-flex  flex-column ">
                        <div class="col-3">
                            <label for="forSale">For Sale:</label>
                            <div class="custom-control custom-radio offset-1">
                                <input value="1" required type="radio" class="custom-control-input " id="yes" name="products[3]" checked>
                                <label class="custom-control-label" for="yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio  offset-1">
                                <input value="0" required type="radio" class="custom-control-input " id="no" name="products[3]">
                                <label class="custom-control-label" for="no">No</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo $_POST['products'][4] ?? "" ?>" required step="1" type="number" class="form-control" name="products[4]">
                                <label for="qtyOnHand">Quantity on Hand</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo $_POST['products'][5] ?? "" ?>" step="any" required type="number" class="form-control" name="products[5]">
                                <label for="UPrice">UPrice($)</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo $_POST['products'][6] ?? "" ?>" step="any" required type="number" class="form-control" name="products[6]">
                                <label for="percentMargin">%Margin</label>
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

<?php
include("./layouts/footer.php"); ?>