<?php
include("./layouts/header.php");


#TODO responsive category and supplier id overlaps in responsive view
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
$id = 1;
//Existing Stock Addedd Price decrease
$UPriceStock = 98.95;
$s = isPrep("UPDATE products SET UPrice=? WHERE id=?");
$s->bind_param("ss", $UPriceStock, $id);
$s->execute();
echo "Products Affected Rows:" . $s->affected_rows . "<br>";



//update price in sales and products

$resultProducts = getById('products', $id);
echo "Product Num rows: " . $resultProducts->num_rows . "<br>";
$rowProducts = $resultProducts->fetch_assoc();
// $x = $rowProducts['UPrice'];
$x = $UPriceStock;
$y = $rowProducts['percentMargin'];
// --products . UPrice + products . percentMargin + 12 % VAT
echo "Product.UPrice: " . $x . "<br>";
echo "Product.%margin: " . $y . "<br>";

$z = $x + ($x * ($y / 100));
$a = $z + ($z * .12);
$a = round($a, 2);
// echo "UPrice+%margin: " . $z . "<br>";
// echo "UPrice+%margin+12%VAT: " . $a . "<br>";

//update listprice of sales and orders

// UPDATE sales, orders SET sales.listPrice=15, orders.listPrice=15 WHERE sales.id=1 and orders.id =1

$resultSales = isPrep("UPDATE sales, orders SET sales.listPrice=?, orders.listPrice=? WHERE sales.id=? AND orders.id=?");
$resultSales->bind_param("ssss", $a, $a, $id, $id);
$resultSales->execute();
echo "Update Sales and Orders Affected Rows:" . $resultSales->affected_rows;

// --products . UPrice + products . percentMargin + 12 % VAT

die();

if (isset($_POST['s']) && $_POST['s'] == 1) {
    $productInfo = [];
    printArr($_POST);

    if (noEmptyField($_POST['products'])) {
        $productInfo = sanitizeInput($_POST['products']);

        //update if there's a stock

        $result = getById('newstocks', $productInfo[0]);
        if ($result->num_rows > 0) { //if there's a stock update
            if ($sql = isPrep("UPDATE newstocks SET qty=?, UPrice=? WHERE id=?")) {
                $sql->bind_param("ssi", $productInfo[1], $productInfo[2], $productInfo[0]);
                if (isExecute($sql)) {
                    $_SESSION['msg'] = success("Stock Succesfully Updated");
                    unset($_POST);
                    header("location:./viewStocks.php");
                }
            }
        } else {
            //          insert if there's no New stock
            if ($sql = isPrep("INSERT INTO newstocks (id,qty, UPrice)VALUES(?,?,?)")) {
                $sql->bind_param("sss", $productInfo[0], $productInfo[1], $productInfo[2]);
                if (isExecute($sql)) {
                    $_SESSION['msg'] = success("New Stock Succesfully Created");
                    unset($_POST);
                    header("location:./viewStocks.php");
                }
            }
        }

        // //update price in sales and products
        // $resultSales = getById('sales', 1);
        // echo "Sales Num rows: " . $resultSales->num_rows;

        // $resultProducts = getById('products', 1);
        // echo "Product Num rows: " . $resultSProducts->num_rows;

        //

    }

    //insert data to newstocks then update the price of products and sales

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
                                if ($result = getAll("products")) {
                                    if ($result->num_rows > 0) {
                                        echo '<option value="" disabled selected>Choose Products</option>';
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value=" . $row['id'] . ">" . $row['name'] . "</option>";
                                            $items[] = json_encode($row);
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