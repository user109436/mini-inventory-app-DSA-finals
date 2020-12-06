<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
?>
<div class="table-responsive p-3">

    <a href="addStock.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Stock</a>
    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
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
            if ($result = getAllFetch("newstocks order by id desc")) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <tr>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['UPrice'] ?></td>
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