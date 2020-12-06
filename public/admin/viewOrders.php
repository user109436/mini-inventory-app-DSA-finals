<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");

?>
<h2>Orders</h2>
<hr>
<div class="table-responsive p-3">

    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <th class="th-sm">Edit
                </th>
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
                    $productExist = getById('products', $row['id']);


            ?>
                    <tr>
                        <td>
                            <a href="editOrder.php?orderID=<?php echo $row['id']
                                                            ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?php echo $row['userID'] ?></td>
                        <td><?php
                            if ($productExist->num_rows == 0) {
                                echo '<span class="red-text">' . $row['id'] . ' <i class="fas fa-database "></i> Product doesn\'t Exist Anymore</span>';
                            } else {
                                echo $row['id'];
                            }

                            ?></td>
                        <td><?php echo $row['qty'] ?></td>
                        <td><?php echo $row['listPrice'] ?></td>
                        <td><?php


                            if ($username = getById('accounts', $row['accountID'], $warning = 0)) {
                                echo $username->fetch_assoc()['username'];
                            } else {
                                echo "<span class='red-text'>  <i class='fas fa-database'></i> Account ID: " . $row['accountID'] . " Account Deleted</span>";
                            }
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