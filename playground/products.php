<?php
include("../private/config.php");

$id = 1;
if ($sql = $conn->prepare("SELECT * from products INNER JOIN sales ON products.id = sales.id INNER JOIN orders ON products.id=orders.id WHERE products.id =?")) {
    $sql->bind_param("s", $id);
    printArr($sql);
    // printArr($sql->fetch_assoc());

    if (isExecute($sql)) {
        $result = $sql->get_result();
        printArr($result->fetch_assoc());
    }
}



// if (delete("sales", 0) > 0) {
//     //$_SESSION['msg'] = success($productInfo[0] . " Succesfully Removed from Sales " . $affectedRowsInOrders);
//     echo "Deleted";
// } else {
//     echo "No data";
// }

// $x = 1.5;
// $y = 0;
// if ($sql = isPrep("UPDATE orders SET listPrice =? WHERE id=?")) {
//     $sql->bind_param("ss", $x, $y);
//     if (isExecute($sql)) {
//         echo $x = $sql->num_rows . " affected rows in Orders ";
//     }
// }

// if ($result = getById('sales', $id, 0)) { //sales id exist UPDATE
//     if ($sql = isPrep("UPDATE sales SET qty=? listPrice=? WHERE id=?")) {
//         $sql->bind_param("sss", $salesQty, $salesListPrice, $id);
//         if (isExecute($sql)) {
//             $msg += "Successfully Updated Sales";
//         }
//     }
// } else { //insert to sales
//     if ($sql = isPrep("INSERT INTO sales ( qty, listPrice,id) VALUES(?,?,?)")) {
//         $sql->bind_param("sss", $salesQty, $salesListPrice, $id);
//         if (isExecute($sql)) {
//             $msg += "Successfully Product";
//             $_SESSION['msg'] = success($productInfo[0] . $msgSales . $affectedRowsInOrders);
//         }
//     }
// }