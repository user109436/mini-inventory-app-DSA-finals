<?php
include("../private/config.php");

// $rows = getAllFetch("suppliers order by id desc");
// $rows = false;
// // printArr($rows);
// if ($rows) {
//     while ($x = $rows->fetch_assoc()) {
//         echo $x['name'] . "<br>" . $x['id'];
//     }
// } else {
//     echo false;
// }

// $str = "Stark\\\'s Industries + Global Corporate";
// echo $supplier = stripslashes($str) . "<br>";
// echo $supplier = str_replace('\"', '', $supplier);

// $error = array("Apple's", "Banana's");
// printArr(sanitizeInput($error));

// $qty = 1;
// $UPrice = 4;
// $productInfo[0] = 1;
// if ($sql = isPre("UPDATE newstocks SET qty=?, UPrice=? WHERE id=?")) {
//     $sql->bind_param("ssi", $qty, $UPrice, $productInfo[0]);
//     $sql->execute();
//     die("Affected Rows:" . $sql->affected_rows);
// } else {

//     echo "failed update";
// }

// function isPre($sql)
// {
//     global $conn;
//     if ($sql = $conn->prepare($sql)) {
//         return $sql;
//     }
//     echo "isPrep failed";
//     return false;
// }
// $id = 1;
// //Existing Stock Addedd Price decrease
// $UPriceStock = 98.95;
// $s = isPrep("UPDATE products SET UPrice=? WHERE id=?");
// $s->bind_param("ss", $UPriceStock, $id);
// $s->execute();
// echo "Products Affected Rows:" . $s->affected_rows . "<br>";



// //update price in sales and products

// $resultProducts = getById('products', $id);
// echo "Product Num rows: " . $resultProducts->num_rows . "<br>";
// $rowProducts = $resultProducts->fetch_assoc();
// // $x = $rowProducts['UPrice'];
// $x = $UPriceStock;
// $y = $rowProducts['percentMargin'];
// // --products . UPrice + products . percentMargin + 12 % VAT
// echo "Product.UPrice: " . $x . "<br>";
// echo "Product.%margin: " . $y . "<br>";

// $z = $x + ($x * ($y / 100));
// $a = $z + ($z * .12);
// $a = round($a, 2);
// // echo "UPrice+%margin: " . $z . "<br>";
// // echo "UPrice+%margin+12%VAT: " . $a . "<br>";

// //update listprice of sales and orders

// // UPDATE sales, orders SET sales.listPrice=15, sales.qty, orders.listPrice=15 WHERE sales.id=1 and orders.id =1

// $resultSales = isPrep("UPDATE sales, orders SET sales.listPrice=?, orders.listPrice=? WHERE sales.id=? AND orders.id=?");
// $resultSales->bind_param("ssss", $a, $a, $id, $id);
// $resultSales->execute();
// echo "Update Sales and Orders Affected Rows:" . $resultSales->affected_rows;

// // --products . UPrice + products . percentMargin + 12 % VAT
