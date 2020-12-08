<?php
include("./layouts/header.php");
if (isset($_GET['cancel']) and !empty($_GET['cancel'])) {
    $dateOrder = $_GET['cancel'];
    $dateOrder = str_replace("%20", " ", $dateOrder);
    //cancel order return qty to sales and products

    if ($sql = isPrep("SELECT * FROM orders WHERE date=?")) {
        $sql->bind_param("s", $dateOrder);
        if (isExecute($sql)) {
            $order = $sql->get_result();
            $orderData = $order->fetch_assoc();
            if ($orderData['state'] == 4) {
                $_SESSION['msg'] = warning("Date Order: " . $dateOrder . " Item Already Cancelled");
            } else {

                $msg = "";
                //check if id exist in products
                if ($prod = getById('products', $orderData['id'])) {
                    $productQty = $prod->fetch_assoc()['qtyOnHand'];
                    $updatedQty = $productQty + $orderData['qty'];

                    //return qty to products 
                    if ($prodUpdate = isPrep("UPDATE products SET qtyOnHand=? WHERE id=?")) {
                        $prodUpdate->bind_param("ss", $updatedQty, $orderData['id']);
                        if (isExecute($prodUpdate)) {
                            $msg .= " " . $prodUpdate->affected_rows . "  Change in Products";
                        }
                    }
                }
                //check if id exist in sales
                if ($saleData = getById('sales', $orderData['id'])) {
                    $saleQty = $saleData->fetch_assoc()['qty'];
                    $updatedQty = $saleQty + $orderData['qty'];

                    //return qty to products 
                    if ($saleUpdate = isPrep("UPDATE sales SET qty=? WHERE id=?")) {
                        $saleUpdate->bind_param("ss", $updatedQty, $orderData['id']);
                        if (isExecute($saleUpdate)) {
                            $msg .= " " . $saleUpdate->affected_rows . "  Change in Sales";
                        }
                    }
                }

                //update state
                $cancel = 4;
                if ($update = isPrep("UPDATE orders SET state=? WHERE date=?") and $msg != null) {
                    $update->bind_param("ss", $cancel, $dateOrder);
                    if (isExecute($update)) {
                        $_SESSION['msg'] = success("Date Order: " . $dateOrder . " Successfully Cancelled" . $msg);
                    }
                }
            }
            header("location:orders.php");
        }
    }
}

?>
<div class="table-responsive p-3">

    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>

                <th class="th-sm">Manipulate
                </th>
                <th class="th-sm">Status
                </th>
                <th class="th-sm">Product
                </th>
                <th class="th-sm">Quantity
                </th>
                <th class="th-sm">List Price
                </th>
                <th class="th-sm">Date Ordered
                </th>


            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("orders WHERE userID=" . $_SESSION['accountID'] . " order by date desc")) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>

                        <?php

                        //display cancell if not yet processing

                        if ($row['state'] < 3) { // order state is processing
                            echo '<td class="blue-text"><i class="fas fa-truck fa-lg"></i>';
                        } else if ($row['state'] == 4) { //cancelled by user
                            echo "<td class=''>Cancelled</td>";
                        } else {
                            echo '<td><a href="orders.php?cancel=' . $row['date'] . '" class="text-danger btn-sm"><i class="far fa-times-circle fa-lg"></i> Cancel Order</a></td>';
                        }
                        ?>
                        <?php echo orderState($row['state']);
                        ?>

                        <td><?php
                            if ($productExist = getById('products', $row['id'], 1, "ID: " . $row['id'] . " Product Deleted")) {

                                if ($productExist->num_rows == 0) {
                                    echo '<span class="red-text"><i class="fas fa-database "></i> Product doesn\'t Exist Anymore</span>';
                                } else {
                                    echo ucwords($productExist->fetch_assoc()['name']);
                                }
                            }


                            ?></td>
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