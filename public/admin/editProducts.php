<?php
include("./layouts/header.php");


#TODO responsive category and supplier id overlaps in responsive view

$_SESSION['id'];
if (isset($_POST['s']) && $_POST['s'] == 1) {

    $productInfo = [];
    $errors = 0;

    //check for empty fields
    foreach ($_POST['products'] as $product) {
        if (empty($product)) {
            $errors++;
        }
    }
    if ($errors == 0) {
        //sanitize values
        foreach ($_POST['products'] as $product) {
            $product = htmlentities(htmlspecialchars($conn->real_escape_string($product)));
            $productInfo[] = filter_var($product, FILTER_SANITIZE_STRING);
        }
        // printArr($_POST);
        // die($_SESSION['id']);
        if ($sql = $conn->prepare("UPDATE products SET name=?, catID=?, supID=?, forsale=?, qtyOnHand=?, UPrice=?, percentMargin=? WHERE id=?")) {
            $sql->bind_param("sssssssi", $productInfo[0], $productInfo[1], $productInfo[2], $productInfo[3], $productInfo[4], $productInfo[5], $productInfo[6], $_SESSION['id']);
            if ($sql->execute()) {
                $_SESSION['msg'] = success("New Product Succesfully Updated");
                unset($_POST);
                header("location:./index.php");
            } else {
                echo error("Unknown Error Occured :(");
            }
        } else {
            echo error();
        }
    } else {
        echo error("Error(s)! Please Fill up the required fields", $errors);
    }
}

if (validateParamID('productID')) {
    $id = $_GET['productID'];
    $_SESSION['id'] = $id;

    $result = getById('products', $id);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $name = $row['name'];
            $catID = $row['catID'];
            $supID = $row['supID'];
            $forsale = $row['forsale'];
            $qtyOnHand = $row['qtyOnHand'];
            $UPrice = $row['UPrice'];
            $percentMargin = $row['percentMargin'];

            $catResult = getById("categories", $catID);
            $catRow = $catResult->fetch_assoc();
            $category = $catRow['name'];

            $supResult = getById("suppliers", $supID);
            $supRow = $supResult->fetch_assoc();
            $supplier = $supRow['name'];
        }



        // if (isset($_POST['s'])) {

        // }
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
                                    <input value="<?php echo $name ?>" required type="text" id="productName" class="form-control" name="products[]">
                                    <label for="productName">Name</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="md-form">
                                    <select class=" p-2 col-6" name="products[]" required>
                                        <?php
                                        if ($result = getAll("categories")) {
                                            if ($result->num_rows > 0) {
                                                echo '<option value="" disabled selected>' . $category . '</option>';
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
                                    <select class=" p-2 col-6" name="products[]" required>
                                        <?php
                                        if ($result = getAll("suppliers")) {
                                            if ($result->num_rows >  0) {
                                                echo '<option value="" disabled selected>' . $supplier . '</option>';
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
                                        <?php

                                        if ($forsale == 1) {
                                            echo '<input value="1" required type="radio" class="custom-control-input " id="yes" name="products[]" checked>';
                                        } else {
                                            echo '<input value="1" required type="radio" class="custom-control-input " id="yes" name="products[]">';
                                        }
                                        ?>
                                        <label class="custom-control-label" for="yes">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio  offset-1">
                                        <?php

                                        if ($forsale == 0) {
                                            echo '<input value="0" required type="radio" class="custom-control-input " id="no" name="products[]" checked>';
                                        } else {
                                            echo '<input value="0" required type="radio" class="custom-control-input " id="no" name="products[]">';
                                        }
                                        ?>
                                        <label class="custom-control-label" for="no">No</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input value="<?php echo $qtyOnHand ?>" required type="number" class="form-control" name="products[]">
                                        <label for="qtyOnHand">Quantity on Hand</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input value="<?php echo $UPrice ?>" required type="number" step="0.001" class="form-control" name="products[]">
                                        <label for="UPrice">UPrice($)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="md-form">
                                        <input value="<?php echo $percentMargin ?>" required type="number" step="0.001" class="form-control" name="products[]">
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
    } else {
        echo warning();
    }
} else {
    echo error("Product Not Found Sorry :(");
}

include("./layouts/footer.php"); ?>