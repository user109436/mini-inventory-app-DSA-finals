<?php
include("./layouts/header.php");


#TODO responsive category and supplier id overlaps in responsive view

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

        if ($sql = $conn->prepare("INSERT INTO products (name, catID, supID, forsale, qtyOnHand, UPrice, percentMargin)VALUES(?,?,?,?,?,?,?)")) {
            $sql->bind_param("sssssss", $productInfo[0], $productInfo[1], $productInfo[2], $productInfo[3], $productInfo[4], $productInfo[5], $productInfo[6]);
            if ($sql->execute()) {
                $_SESSION['msg'] = success("New Product Succesfully Created");
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
                            <input value="<?php echo isset($_POST['products'][0]) ? $_POST['products'][0] : "" ?>" required type="text" id="productName" class="form-control" name="products[]">
                            <label for="productName">Name</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="md-form">
                            <select class=" p-2 col-6" name="products[]" required>
                                <?php
                                if ($result = getAll("categories")) {
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
                            <select class=" p-2 col-6" name="products[]" required>
                                <?php
                                if ($result = getAll("suppliers")) {
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
                                <input value="1" required type="radio" class="custom-control-input " id="yes" name="products[]" checked>
                                <label class="custom-control-label" for="yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio  offset-1">
                                <input value="0" required type="radio" class="custom-control-input " id="no" name="products[]">
                                <label class="custom-control-label" for="no">No</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo isset($_POST['products'][4]) ? $_POST['products'][4] : "" ?>" required type="number" class="form-control" name="products[]">
                                <label for="qtyOnHand">Quantity on Hand</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo isset($_POST['products'][5]) ? $_POST['products'][5] : "" ?>" required type="number" class="form-control" name="products[]">
                                <label for="UPrice">UPrice</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="md-form">
                                <input value="<?php echo isset($_POST['products'][6]) ? $_POST['products'][6] : "" ?>" required type="number" class="form-control" name="products[]">
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