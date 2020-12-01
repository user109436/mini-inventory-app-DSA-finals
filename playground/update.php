<?php
include("../private/config.php");

$qty = 1;
$UPrice = 4;
$productInfo[0] = 1;
if ($sql = isPre("UPDATE newstocks SET qty=?, UPrice=? WHERE id=?")) {
    $sql->bind_param("ssi", $qty, $UPrice, $productInfo[0]);
    $sql->execute();
    die("Affected Rows:" . $sql->affected_rows);
} else {

    echo "failed update";
}

function isPre($sql)
{
    global $conn;
    if ($sql = $conn->prepare($sql)) {
        return $sql;
    }
    echo "isPrep failed";
    return false;
}
