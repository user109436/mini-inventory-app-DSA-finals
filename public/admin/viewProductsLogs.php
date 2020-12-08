<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
pageRestrict();
?>
<div class="table-responsive p-3">
    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <th class="th-sm">Account ID
                </th>
                <th class="th-sm">Activity
                </th>
                <th class="th-sm">Date Made
                </th>
                <th class="th-sm">Product ID
                </th>
                <th class="th-sm">Name
                </th>
                <th class="th-sm">CatID
                </th>
                <th class="th-sm">SupID
                </th>
                <th class="th-sm">For Sale
                </th>
                <th class="th-sm">Qty-on-hand
                </th>
                <th class="th-sm">UPrice($)
                </th>
                <th class="th-sm">%Margin
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("productslogs order by date desc")) {
                while ($row = $result->fetch_assoc()) {

            ?>
                    <tr>
                        <td><?php echo displayAccountType($row['accountID']) ?></td>
                        <td><?php echo activity($row['activity']) ?></td>
                        <td><?php echo $row['date'] ?></td>

                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php
                            if ($cat = getById('categories', $row['catID'])) {
                                echo $cat->fetch_assoc()['name'];
                            } else {
                                echo "<span class='red-text'>  <i class='fas fa-database'></i> Category ID: " . $row['catID'] . "  Deleted</span>";
                            }

                            ?></td>
                        <td><?php
                            if ($sup = getById('suppliers', $row['supID'])) {
                                echo $sup->fetch_assoc()['name'];
                            } else {
                                echo "<span class='red-text'>  <i class='fas fa-database'></i> Supplier ID: " . $row['catID'] . "  Deleted</span>";
                            }

                            ?></td>
                        <td><?php

                            if ($row['forsale']) {
                                echo '<span class="green-text"><i class="fas fa-check-circle fa-lg"></i></span>';
                            } else {
                                echo  '<span class="red-text"> <i class="fas fa-times-circle fa-lg"></i></i></span>';
                            }
                            ?></td>
                        <td><?php echo $row['qtyOnHand'] ?></td>
                        <td><?php echo $row['UPrice'] ?></td>
                        <td><?php echo $row['percentMargin'] ?></td>
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