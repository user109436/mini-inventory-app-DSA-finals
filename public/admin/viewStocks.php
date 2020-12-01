<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
    echo $_SESSION['msg'];
    unset($_SESSION['msg']);
}
isset($_GET['stockID']) ? deleteById('stocks', $_GET['stockID']) : "";
if ($result = openQuery("select * from newstocks order by id desc")) {

?>
    <div class="table-responsive p-3">

        <a href="addStocks.php" class="btn btn-success btn-sm">Add Stocks</a>
        <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
            <thead class="blue white-text">
                <tr>
                    <th class="th-sm">Manipulate
                    </th>
                    <th class="th-sm">Product ID
                    </th>
                    <th class="th-sm">Qty
                    </th>
                    <th class="th-sm">UPrice($)
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                ?>
                        <tr>
                            <td><a href="editStocks.php?stockID=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Edit</a><button onclick="del('index.php?stockID=',this.value)" value="<?php echo $row['id'] ?>" class="deleteProduct btn btn-danger btn-sm">Delete</button></td>
                            <td><?php echo $row['id'] ?></td>
                            <td><?php echo $row['qty'] ?></td>
                            <td><?php echo $row['UPrice'] ?></td>
                        </tr>
            <?php
                    }
                } else {
                    echo warning();
                }
            }

            ?>
            </tbody>
        </table>
    </div>
    <?php
    include("./layouts/footer.php");
    ?>