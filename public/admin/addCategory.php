<?php
include("./layouts/header.php");

#TODO responsive category and suppliers id overlaps in responsive view

if (isset($_POST['s']) && $_POST['s'] == 1) {
    $category = sanitizeInput($_POST['category']);
    if (!empty($category[0])) {

        if ($sql = isPrep("INSERT INTO categories (name) VALUES(?)")) {
            $sql->bind_param("s", $category[0]);
            if (isExecute($sql)) {
                $_SESSION['msg'] = success($category[0] . " Successfully Added");
                header("location:viewCategories.php");
            }
        }
    } else {
        echo error("Empty Field");
    }
}
?>

<div class="container mt-5">
    <!-- Material form register -->
    <div class="row">
    </div>
    <div class=" card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Add Category</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="form-row">
                    <div class="col-12">
                        <div class="md-form">
                            <input value="<?php echo isset($_POST['category'][0]) ?? "" ?>" required type="text" class="form-control" name="category[0]">
                            <label for="category">Category Name</label>
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
<script type="text/javascript">
</script>
<?php
include("./layouts/footer.php"); ?>