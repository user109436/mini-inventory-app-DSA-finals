<?php

function categoryExist($categories, $category)
{
    foreach ($categories as $x) {
        if ($x == $category) {
            return true;
        }
        return false;
    }
}
function supplierExist($suppliers, $supplier)
{
    foreach ($suppliers as $x) {
        if ($x == $supplier) {
            return true;
        }
        return false;
    }
}


function activity($activity)
{
    if ($activity == 1) {
        return 'create';
    } else if ($activity == 2) {
        return 'edit';
    } else if ($activity == 3) {
        return 'delete';
    }
    return false;
}
function accountType($accountType)
{
    if ($accountType == 1) {
        return 'user';
    } else if ($accountType == 2) {
        return 'Encoder';
    } else if ($accountType == 3) {
        return 'seniof staff';
    } else if ($accountType == 4) {
        return 'system admin';
    }
    return false;
}

function orderState($state = 3)
{

    if ($state == 1) {
        return '<td><span class="badge badge-success"><i class="fas fa-check-circle"></i> Done</span></td>';
    } else if ($state == 2) {
        return '<td><span class="badge badge-info"><i class="fas fa-spinner"></i> Processing</span></td>';
    } else if ($state == 3) {
        return '<td><span class="badge badge-warning"><i class="fas fa-ban"></i> Pending</span></td>';
    } else if ($state == 4) {
        return '<td><span class="badge badge-danger"><i class="far fa-times-circle"></i> Cancelled</span></td>';
    }
    return false;
}

//LOGS


function logProduct($productInfo, $accountID, $activity)
{
    global $conn;
    if ($sql = isPrep("INSERT INTO productslogs
     (id, name, catID, supID, forsale, qtyOnHand, UPrice, percentMargin, accountID, activity)
                                VALUES(?,?,?,?,?,?,?,?,?,?)")) {
        $sql->bind_param("ssssssssss", $productInfo[0], $productInfo[1], $productInfo[2], $productInfo[3], $productInfo[4], $productInfo[5], $productInfo[6], $productInfo[7], $accountID, $activity);
        if (isExecute($sql)) {
            return true;
        }
        die("Cannot log Products");
        return false;
    }
}
function createEditProduct($id, $productInfo, $edit = 0, $msgSales = " Successfully Created and Added to Sales ", $msgNoSales = " Successfully Created ")
{
    global $conn; {
        $salesQty = $productInfo[4];
        $UPrice = $productInfo[5];
        $percentMargin = $productInfo[6] / 100;
        //id=last insert_id
        $salesListPrice = $UPrice + ($UPrice * $percentMargin); //Uprice+percentMargin
        $salesListPrice += ($salesListPrice * .12); //12% VAT
        $salesListPrice = round($salesListPrice, 2);

        //update orders.listPrice, even if there's no matching orders
        if ($sql = isPrep("UPDATE orders SET listPrice =? WHERE id=?")) {
            $sql->bind_param("ss", $salesListPrice, $id);
            if (isExecute($sql)) {
                $affectedRowsInOrders = $sql->num_rows . " changes in Orders ";
            }
        }
        //for sale
        if ($productInfo[3]) { //update if there's existing id else insert in sales if for sale =1
            //insert to sales
            if ($sql = isPrep("INSERT INTO sales (qty, listPrice,id) VALUES(?,?,?)")) {
                $sql->bind_param("sss", $salesQty, $salesListPrice, $id);
                if (isExecute($sql)) {
                    $_SESSION['msg'] = success($productInfo[0] . $msgSales . $affectedRowsInOrders);
                }
            }
        } else { //not for sale
            // delete if there's existing id
            if ($edit) {
                unset($sql);
                if (delete("sales", $id) > 0) {
                    $_SESSION['msg'] = success($productInfo[0] . " Succesfully Removed from Sales " . $affectedRowsInOrders);
                }
            }
            echo $_SESSION['msg'] = success($productInfo[0] . $msgNoSales . $affectedRowsInOrders);
        }
        header("location:viewProducts.php");
    }
}

// function logSales($salesQty, $salesListPrice, $id, $accountID, $activity)
// {
//     global $conn;
//     if ($sql = isPrep("INSERT INTO saleslogs (qty, listPrice,id) VALUES(?,?,?)")) {
//         $sql->bind_param("sss", $salesQty, $salesListPrice, $id);
//         if (isExecute($sql)) {
//             return true;
//         }
//         die("Cannot log Sales");
//         return false;
//     }
// }
