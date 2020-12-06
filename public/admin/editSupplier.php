<?php
include("./layouts/header.php");

#TODO responsive category and supplier id overlaps in responsive view
if (isset($_POST['s']) && $_POST['s'] == 1) {
    $supplier = sanitizeInput($_POST['supplier']);
    if (!empty($supplier[0]) && !empty($supplier[1] += 0)) {
        if ($sql = isPrep("UPDATE suppliers SET name=? WHERE id=?")) {
            $sql->bind_param("ss", $supplier[0], $supplier[1]);
            if (isExecute($sql)) {
                $_SESSION['msg'] = success($supplier[0] . " Successfully Updated");
                header("location:viewSuppliers.php");
            }
        }
    } else {
        echo error("Empty Field");
    }
}
if (validateParamID('supplierID')) {
    $id = $_GET['supplierID'];
    $result = getById('suppliers', $id);
    if ($result->num_rows > 0) {
        $supplier = stripslashes($result->fetch_assoc()['name']);
?>

        <div class="container mt-5">
            <!-- Material form register -->
            <div class="row">
            </div>
            <div class=" card">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Add Supplier</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="form-row">
                            <div class="col-12">
                                <div class="md-form">
                                    <input value="<?php echo $supplier; ?>" required type="text" class="form-control" name="supplier[0]">
                                    <label for="supplier">Supplier Name</label>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" value="<?php echo $id ?>" name="supplier[1]">
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
    } else {
        echo warning();
    }
} else {
    echo error("Supplier Not Found Sorry :( it's ID maybe Invalid");
}
include("./layouts/footer.php"); ?>