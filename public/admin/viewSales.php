<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");

?>
<div class="table-responsive p-3">

    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <th class="th-sm">Product
                </th>
                <th class="th-sm">Product ID
                </th>
                <th class="th-sm">Qty
                </th>
                <th class="th-sm">List Price
                </th>
                <th class="th-sm">Date Made Public
                </th>

            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("sales order by id desc")) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <tr>
                        <td><?php
                            echo getById('products', $row['id'])->fetch_assoc()['name'];
                            ?></td>
                        <td><?php echo $row['id'] ?></td>

                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['listPrice'] ?></td>
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