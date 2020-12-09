<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
?>
<div class="table-responsive p-3">
    <div class="container actions">
        <a href="addStock.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Stock</a>
    </div>

    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <th class="th-sm">Log By
                </th>
                <th class="th-sm">Product ID
                </th>
                <th class="th-sm">Qty
                </th>
                <th class="th-sm">UPrice($)
                </th>
                <th class="th-sm">Date Log
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("newstocks order by date desc")) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <tr>
                        <td><?php
                            displayAccountType($row['accountID']);


                            ?></td>
                        <td><?php echo $row['id'] ?></td>
                        <td><?phpecho $row['qty'] ?></td>
                        <td><?php echo $row['UPrice'] ?></td>
                        <td><?php echo $row['date'] ?></td>

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