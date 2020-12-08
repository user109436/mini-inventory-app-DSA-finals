<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");

?>
<div class="table-responsive p-3">

    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <?php
                restrict('<th class="th-sm">Edit
        </th>');
                ?>

                <th class="th-sm">User ID
                </th>
                <th class="th-sm">Product ID
                </th>
                <th class="th-sm">Quantity
                </th>
                <th class="th-sm">List Price
                </th>
                <th class="th-sm">Last Modified by
                </th>
                <th class="th-sm">Status
                </th>
                <th class="th-sm">Date Ordered
                </th>


            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("orders order by date desc")) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>

                        <?php
                        if ($row['state'] == 1) {
                            echo '<td class="blue-text"><i class="fas fa-truck fa-lg"></i>';
                        } else {

                            restrict('<td><a href="editOrder.php?orderID=' . $row['date'] . '
                                                            " class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>

                        </td>');
                        }

                        ?>

                        <td><?php echo $row['userID'] ?></td>
                        <td><?php
                            if ($productExist = getById('products', $row['id'], 1, "ID: " . $row['id'] . " Product Deleted")) {

                                if ($productExist->num_rows == 0) {
                                    echo '<span class="red-text">' . $row['id'] . ' <i class="fas fa-database "></i> Product doesn\'t Exist Anymore</span>';
                                } else {
                                    echo $row['id'];
                                }
                            }


                            ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['listPrice'] ?></td>
                        <td><?php
                            displayAccountType($row['accountID']);

                            ?></td>
                        <?php echo orderState($row['state']);
                        ?>
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