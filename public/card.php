   <div class="row d-flex justify-content-center mt-5">


       <?php

        if (isset($_POST['s']) and $_POST['s'] == 1) {
            $orders = sanitizeInput($_POST['orders']);
            $qtyOrder = $orders[0] = (int)$orders[0];
            $id = $orders[1] = (int)$orders[1]; //id


            if (noEmptyField($orders)) {
                //place the order then update the sales qty including the products qty

                //get latest info from sales
                if ($saleData = getById('sales', $id)) {
                    $sales = $saleData->fetch_assoc();


                    //process if qty <= salesQty
                    echo "orders: " . $qtyOrder . " salesQty:" . $sales['qty'];
                    if ($qtyOrder <= $sales['qty']) {
                        //process order
                        $updatedQty = $sales['qty'] - $qtyOrder;

                        //insert to orders

                        $state = 3;
                        if ($orders = isPrep("INSERT INTO orders (id, userID, qty, listPrice, accountID, state) VALUES (?,?,?,?,?,?)")) {
                            $orders->bind_param("iiidii", $id, $_SESSION['accountID'], $qtyOrder, $sales['listPrice'], $_SESSION['accountID'], $state);
                            if (isExecute($orders)) {
                                $msg = "Order Successfully Placed";
                                //message order placed

                                //update sales qty
                                if ($saleUpdate = isPrep("UPDATE sales SET qty=? WHERE id=?")) {
                                    $saleUpdate->bind_param("ss", $updatedQty, $id);
                                    if (isExecute($saleUpdate)) {
                                        $msg .= $saleUpdate->affected_rows . " Sales ";
                                    }
                                }
                                //update products qty
                                if ($productUpdate = isPrep("UPDATE products SET qtyOnHand=? WHERE id=?")) {
                                    $productUpdate->bind_param("ss", $updatedQty, $id);
                                    if (isExecute($productUpdate)) {
                                        $msg .= $productUpdate->affected_rows . ", Products";
                                    }
                                }
                                unset($_POST);
                                $_SESSION['msg'] = success($msg);
                                header("location:home.php");
                            }
                        }
                    } else {
                        $_SESSION['msg'] = warning("order qty exceed the available products qty");
                    }
                }
            }
        }
        $productCount = 0;
        if ($sql = getAllFetch('sales order by id desc', 1, "No Available Products as of the Moment")) {
            while ($sales = $sql->fetch_assoc()) {
                // printArr($sales);
                $salesID = $sales['id'];
                $salesListPrice = $sales['listPrice'];
                $salesQty = $sales['qty'];


                if ($prod = getById('products', $salesID)) {
                    while ($product = $prod->fetch_assoc()) {
                        $productCount++;
        ?>
                       <div class="card col-sm-4 col-md-3 m-2 col-lg-2 indigo ligthen-5 ">
                           <!-- Card image -->
                           <div class="view overlay">
                               <img class="card-img-top" src="node_modules/mdbootstrap/img/product.svg" alt="Product">
                               <span class="badge badge-dark">Image Upcoming</span>
                               <a href="#!">
                                   <div class="mask rgba-white-slight"></div>
                               </a>
                           </div>

                           <!-- Card content -->
                           <div class="card-body">
                               <!-- Title -->
                               <h4 class="card-title white-text"><?php echo $product['name'] ?>
                               </h4>
                               <span class="badge badge-info"><?php
                                                                if ($cat = getById('categories', $product['catID'])) {
                                                                    echo $cat->fetch_assoc()['name'];
                                                                }

                                                                ?></span>
                               <span class="badge badge-danger"> Qty:<?php echo $salesQty ?></span><br>
                               <span class="badge badge-success">Brand:<?php
                                                                        if ($sup = getById('suppliers', $product['supID'])) {
                                                                            echo $sup->fetch_assoc()['name'];
                                                                        }

                                                                        ?>
                               </span>
                               <h2 class="white-text font-weight-bold"><?php echo $salesListPrice . "$" ?></h2>

                               <?php

                                if ($salesQty != 0) {


                                ?>
                                   <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                       <div class="md-form">
                                           <input value=" <?php echo $_POST['orders'][$productCount] ?? ""
                                                            ?>" step="1" min="1" max="<?php echo $salesQty ?>" required type="number" class="form-control white-text" name="orders[<?php echo $productCount ?>]">
                                           <label for="orderQty" class="white-text ">Order Qty</label>
                                       </div>

                                       <input type="hidden" value=<?php echo $product['id'] ?> name="orders[0]">

                                       <!-- Button -->
                                       <button type="submit" value="1" name="s" class="btn btn-primary btn-block">Place Order <i class="fas fa-sign-in-alt fa-lg"></i></button>

                                   </form>
                               <?php
                                } else {
                                    //out of stock
                                    echo  '<h2 class="yellow-text font-weight-bold">Out of Stock</h2>';
                                }

                                ?>
                           </div>
                       </div>

                       <!-- Card -->

       <?php
                    }
                }
            }
        }

        ?>
   </div>