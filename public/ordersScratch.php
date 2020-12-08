<div class="container-fluid mt-5">
        <div class="row">
            <div class="col-6">
                <div class="table-responsive p-3">

                    <table id="orders" class="table tabble-striped" cellspacing="0" width="100%">
                        <thead class="blue white-text">
                            <tr>

                                <th class="th-sm">Product Name
                                <th class="th-sm">Price($)
                                </th>
                                <th class="th-sm">Qty
                                </th>
                                <th class="th-sm">Your Order
                                </th>

                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            if ($result = getAllFetch("sales order by date desc")) {
                                while ($row = $result->fetch_assoc()) {

                                    if ($prod = getById('products', $row['id'])) {
                                        $product = $prod->fetch_assoc();
                            ?>
                                        <tr>
                                            <td>
                                                <a href="order.php">
                                                    <?php echo $product['name'] ?></a>
                                                <?php
                                                if ($cat = getById('categories', $product['catID'], 1, "Unknown")) {
                                                    echo "<span class='badge badge-pill badge-warning'>Brand: " . $cat->fetch_assoc()['name'] . "</span>";
                                                }

                                                ?>
                                                <?php
                                                if ($sup = getById('suppliers', $product['supID'], 1, "Unknown")) {
                                                    echo "<span class='badge badge-pill badge-info'>Brand: " . $sup->fetch_assoc()['name'] . "</span>";
                                                }

                                                ?></td>
                                            <td> <?php echo $row['listPrice'] ?></td>
                                            <td><?php echo $row['qty'] ?></td>
                                            <td>
                                                <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                                                    <div class="md-form">
                                                        <input type="number" class="form-control" step="1" min="1" max="<?php echo $row['qty'] ?>" id="order" name="order[]">
                                                        <label for="order">How Many Items?</label>
                                                    </div>

                                                </form>
                                            </td>
                                        </tr>
                            <?php

                                    }
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-5">
                My orders
            </div>
        </div>
    </div>