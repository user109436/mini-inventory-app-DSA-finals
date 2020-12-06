<?php
include("../private/config.php");

$qtyOnHand = 1;
$UPrice = 2.5;
$listPrice = 4.5;
$id = 2;
$productInfo = array(10, 10, 98.95);

$msg = null;
$msg .= " Changes in Sales";
$msg .= " Changes in Products";
$msg .= " Changes in Orders";

echo $msg;

// $q = "UPDATE products, sales, orders SET products.qtyOnHand=?, products.UPrice=?
//                     ,sales.listPrice=?, sales.qty=?, orders.listPrice=? WHERE sales.id=? and orders.id =? and products.id=?";

// if ($sql = isPrep($q)) {
//     $sql->bind_param("ssssssss", $qtyOnHand, $UPrice, $listPrice, $qtyOnHand, $listPrice, $id, $id, $id);
//     if (isExecute($sql)) {
//         echo "affected rows: " . $sql->affected_rows;
//     }
// }
// if ($sql = isPrep("UPDATE products SET qtyOnHand=?, UPrice=? WHERE id=?")) {
//     $sql->bind_param("sss", $productInfo[1], $productInfo[2], $productInfo[0]);
//     if (isExecute($sql)) {
//         printArr($sql->num_rows);
//     }
// }
// if ($sql = getById('products', $productInfo[0], 1, "Cannot Add Stocks To Non-Existing Product")) { //get qty and uprice
// echo $sql->num_rows;
// $row = $sql->fetch_assoc();
// $percentMargin = $row['percentMargin'] / 100;
// $qty = $row['qtyOnHand'];
// $listPrice = $productInfo[2] + ($productInfo[2] * $percentMargin);
// echo "<br>" . "listPrice: " . $listPrice += $listPrice * .12;
// echo "<br>" . "Qty: " . $qty += $productInfo[1];
// }
die();


// if ($sql = isPrep("SELECT * FROM newstocks WHERE id =?")) {
//     $sql->bind_param("s", $id);
//     if (isExecute($sql)) {
//         $result = $sql->get_result();
//         printArr($newstock = $result->fetch_assoc());
//         if ($result->num_rows > 0) {

//             $productQty = $productInfo[4];
//             $productUPrice = $productInfo[5];
//             $productPercentMargin = $productInfo[6];

//             $salesQty = $newstock['qty'] + $productQty;
//             $salesListPrice = $newstock['UPrice'] + ($newstock['UPrice'] * ($productPercentMargin / 100));
//             $salesListPrice += round($salesListPrice * 0.12, 2);

//             echo "Sales Qty:" . $salesQty . "<br>";
//             echo "Sales List Price:" . $salesListPrice;
//             die();
//             //insert sales.qty=newtsocks.qty + products.qty
//             /*
//                 x=newstocks.UPrice + (newstocks.Price*(products.percentMargin/100))
//                 sales.listPrice =x+(x*0.12); 
//             */
//         } else {
//             echo " Successfully Created and Added to Sales";

//             // if ($productInfo[3]) { //if forsale, insert into sales
//             //     $qty = $productInfo[4];
//             //     $UPrice = $productInfo[5];
//             //     $percentMargin = $productInfo[6];
//             //     //id=last insert_id
//             //     $listPrice = $UPrice + ($UPrice * ($percentMargin / 100)); //Uprice+percentMargin
//             //     $listPrice += $listPrice * 0.12; //12% VAT
//             //     //insert to sales
//             //     if ($sql = isPrep("INSERT INTO sales (id, qty, listPrice) VALUES(?,?,?)")) {
//             //         $sql->bind_param("sss", $id, $qty, $listPrice);
//             //         if (isExecute($sql)) {
//             //             $_SESSION['message'] = success($productInfo[0] . " Successfully Created and Added to Sales");
//             //             header("location:viewProducts.php");
//             //         }
//             //     }
//             // }
//         }
//         //newstocks.qty=0
//         //insert sales.qty=prodcuts.qty
//         /*
//                 x=products.UPrice + (products.Price*(products.percentMargin/100))
//                 sales.listPrice =x+(x*0.12); 
//             */
//     }
// }
