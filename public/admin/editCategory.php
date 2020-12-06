<?php
include("./layouts/header.php");
//category and suppliers can still be optimized but not top priority right now

#TODO responsive category and supplier id overlaps in responsive view
if (isset($_POST['s']) && $_POST['s'] == 1) {
    $category = sanitizeInput($_POST['category']);
    if (!empty($category[0]) && !empty($category[1] += 0)) {
        if ($sql = isPrep("UPDATE categories SET name=? WHERE id=?")) {
            $sql->bind_param("ss", $category[0], $category[1]);
            if (isExecute($sql)) {
                $_SESSION['msg'] = success($category[0] . " Successfully Updated");
                header("location:viewCategories.php");
            }
        }
    } else {
        echo error("Empty Field");
    }
}
if (validateParamID('categoryID')) {
    $id = $_GET['categoryID'];
    $result = getById('categories', $id);
    if ($result->num_rows > 0) {
        $category = stripslashes($result->fetch_assoc()['name']);
?>

        <div class="container mt-5">
            <!-- Material form register -->
            <div class="row">
            </div>
            <div class=" card">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Add category</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="form-row">
                            <div class="col-12">
                                <div class="md-form">
                                    <input value="<?php echo $category; ?>" required type="text" class="form-control" name="category[0]">
                                    <label for="category">Category Name</label>
                                </div>
                            </div>
                        </div>


                        <input type="hidden" value="<?php echo $id ?>" name="category[1]">
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
    echo error("Category Not Found Sorry :( it's ID maybe Invalid");
}
include("./layouts/footer.php"); ?>