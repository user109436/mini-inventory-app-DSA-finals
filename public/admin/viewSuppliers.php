<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
deleteItem('suppliers', 'supplierID', 'viewSuppliers.php');

?>
<div class="table-responsive p-3">

    <a href="addSupplier.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Supplier</a>
    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <?php
                restrict(' <th class="th-sm">Manipulate
                </th>');
                ?>

                <th class="th-sm">ID
                </th>
                <th class="th-sm">Name
                </th>
                <th class="th-sm">Number of Products from this supplier
                </th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("suppliers order by id desc")) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <?php
                        restrict('<td><a href="editSupplier.php?supplierID=' .  $row['id'] . '" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a><button onclick="del(\'viewSuppliers.php?supplierID=\',this.value)" value="' . $row['id'] . '" class=" btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></td>
                        ');
                        ?>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>

                        <?php if ($suppliers = openQuery("select * from products  where supID=" . $row['id'])) {
                            echo "<td> $suppliers->num_rows</td>";
                        }
                        ?>


                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>
</div>
<?php
include("./layouts/footer.php");
?>