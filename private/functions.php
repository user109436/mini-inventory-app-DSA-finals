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
        return '    <span class="badge badge-pill badge-success"><i class="fas fa-plus-circle"></i>Create<span>';
    } else if ($activity == 2) {
        return '<span class="badge badge-pill badge-warning" ><i class="fas fa-edit"></i>Edit</span>';
    } else if ($activity == 3) {
        return '    <span class="badge badge-pill badge-danger"><i class="fas fa-trash-alt"></i>Delete</span>';
    }
    return false;
}
function accountType($accountType)
{
    if ($accountType == 1) {
        return '<span class="badge badge-pill badge-default">User</span>';
    } else if ($accountType == 2) {
        return '<span class="badge badge-pill badge-warning">Encoder</span>';
    } else if ($accountType == 3) {
        return '<span class="badge badge-pill badge-secondary">Senior Staff</span>';
    } else if ($accountType == 4) {
        return '<span class="badge badge-pill badge-success">System Admin</span>';
    }
    return false;
}
function restrict($el)
{
    if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType'] >= 3 and $_SESSION['accountType'] <= 4) {
        echo $el;
        return true;
    }
    return false;
}
function pageRestrict($loc = "./")
{
    if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType'] < 3) {
        $_SESSION['msg'] = warning("You do not have Authorization to view some page please contact your System Admin");
        header("location:" . $loc);
    }
}
function allowSystemAdmin($el)
{

    if (isset($_SESSION['accountID'])  and isset($_SESSION['accountType']) and $_SESSION['accountType'] == 4) {
        echo $el;
        return true;
    }
    return false;
}




function displayAccountType($id)
{
    if ($log = getById('accounts', $id, 0)) {
        $account = $log->fetch_assoc();
        echo $account['username'] . " " . accountType($account['accountType']);
    } else {
        echo "<span class='red-text'>  <i class='fas fa-database'></i> Account ID: " . $id . " Deleted</span>";
    }
}
function get_starred($str)
{
    $str_length = strlen($str);
    return substr($str, 0, 0) . str_repeat('*', $str_length);
}

function orderState($state = 3)
{

    if ($state == 1) {
        return '<td><span class="badge badge-success"><i class="fas fa-check-circle"></i> Done</span></td>';
    } else if ($state == 2) {
        return '<td><span class="badge badge-info"><i class="fas fa-spinner"></i> Processing</span></td>';
    } else if ($state == 3) {
        return '<td><span class="badge badge-warning"><i class="fas fa-ban"></i> To Review</span></td>';
    } else if ($state == 4) {
        return '<td><span class="badge badge-danger"><i class="far fa-times-circle"></i> Cancelled</span></td>';
    }
    return false;
}

function returnQtySaleProd($dateOrder)
{
    global $conn;
    if ($sql = isPrep("SELECT * FROM orders WHERE date=?")) {
        $sql->bind_param("s", $dateOrder);
        if (isExecute($sql)) {
            $order = $sql->get_result();
            $orderData = $order->fetch_assoc();
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
            if ($msg != "") {
                return $msg;
            }
        }
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
            delete('sales', $id);
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
