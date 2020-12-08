<?php
include("./layouts/header.php");
pageRestrict();
if (isset($_POST['s']) && $_POST['s'] == 1) {
    $productInfo = sanitizeInput($_POST['products']); //sanitize values
    $productInfo[7] = (int)$productInfo[7];
    if (noEmptyField($_POST['products'])) {
        if ($sql = isPrep("UPDATE products SET name=?, catID=?, supID=?, forsale=?, qtyOnHand=?, UPrice=?, percentMargin=? WHERE id=?")) {
            $sql->bind_param("ssssssss", $productInfo[0], $productInfo[1], $productInfo[2], $productInfo[3], $productInfo[4], $productInfo[5], $productInfo[6], $productInfo[7]);
            if (isExecute($sql)) {

                createEditProduct($productInfo[7], $productInfo, 1, " Succesfully Updated in Products and Sales", " Successfully Updated ");
                if ($sql = getById('products', $productInfo[7])) {
                    logProduct($sql->fetch_all()[0], $_SESSION['accountID'], 2);
                }
            }
        }
    }
}

if (isset($_GET['productID']) && validateParamID('productID')) {
    $id = $_GET['productID'];

    $result = getById('products', $id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $catID = $row['catID'];
        $supID = $row['supID'];
        $forsale = $row['forsale'];
        $qtyOnHand = $row['qtyOnHand'];
        $UPrice = $row['UPrice'];
        $percentMargin = $row['percentMargin'];

        $catResult = getById("categories", $catID);
        $cat = $catResult->fetch_assoc();
        $category = $cat['name'];
        $categoryID = $cat['id'];

        $supResult = getById("suppliers", $supID);
        $sup = $supResult->fetch_assoc();
        $supplier = $sup['name'];
        $supplierID = $sup['id'];
?>

        <div class="container mt-5">
            <!-- Material form register -->
            <div class="row">
            </div>
            <div class=" card">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Edit Products</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="form-row">
                            <div class="col-12">
                                <!-- First name -->
                                <div class="md-form">
                                    <input value="<?php echo $name ?>" required type="text" id="productName" class="form-control" name="products[0]">
                                    <label for="productName">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="md-form">
                                    <select class=" p-2 col-6" name="products[1]" required>
                                        <?php
                                        if ($result = getAllFetch("categories")) {
                                            if ($result->num_rows > 0) {
                                                echo '<option value=' . $categoryID . '>' . $category . '</option>';
                                                while ($row = $result->fetch_assoc()) {

                                                    if ($category != $row['name']) {
                                                        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                    }
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
                                                echo '<option value=' . $supplierID . ' >' . $supplier . '</option>';
                                                while ($row = $result->fetch_assoc()) {
                                                    if ($supplier != $row['name']) {
                                                        echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                                    }
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
                                        <?php

                                        if ($forsale == 1) {
                                            echo '<input value="1" required type="radio" class="custom-control-input " id="yes" name="products[3]" checked>';
                                        } else {
                                            echo '<input value="1" required type="radio" class="custom-control-input " id="yes" name="products[3]">';
                                        }
                                        ?>
                                        <label class="custom-control-label" for="yes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio  offset-1">
                                        <?php

                                        if ($forsale == 0) {
                                            echo '<input value="0" required type="radio" class="custom-control-input " id="no" name="products[3]" checked>';
                                        } else {
                                            echo '<input value="0" required type="radio" class="custom-control-input " id="no" name="products[3]">';
                                        }
                                        ?>
                                        <label class="custom-control-label" for="no">No</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input value="<?php echo $qtyOnHand ?>" required type="number" class="form-control" name="products[4]">
                                        <label for="qtyOnHand">Quantity on Hand</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input value="<?php echo $UPrice ?>" required type="number" step="0.001" class="form-control" name="products[5]">
                                        <label for="UPrice">UPrice($)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input value="<?php echo $percentMargin ?>" required type="number" step="0.001" class="form-control" name="products[6]">
                                        <label for="percentMargin">%Margin</label>
                                    </div>
                                </div>
                                <div>
                                </div>
                            </div>


                            <input type="hidden" value="<?php echo $id ?>" name="products[7]">
                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="s" value="1">Submit</button>


                            <hr>

                    </form>

                </div>

            </div>
            <!-- Material form register -->
        </div>

<?php
    } else {
        echo warning();
    }
} else {
    echo error("Product Not Found Sorry :(");
}

include("./layouts/footer.php"); ?>