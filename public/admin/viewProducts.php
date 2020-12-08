<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");

if (validateParamID('productID')) {
  if ($sql = getById('products', $_GET['productID'])) {
    logProduct($sql->fetach_all()[0], $_SESSION['accountID'], 3);
  }
}
?>
<div class="table-responsive p-3">

  <a href="addProduct.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Product </a>
  <a href="addStock.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Stock</a>

  <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
    <thead class="blue white-text">
      <tr>
        <?php
        restrict('<th class="th-sm">Edit </th>');
        ?>

        <th class="th-sm">ID
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
      if ($result = getAllFetch("products order by id desc")) {
        while ($row = $result->fetch_assoc()) {

      ?>
          <tr>
            <?php
            restrict('<td><a href="editProduct.php?productID=' . $row['id'] . '" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a></td>');
            ?>
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
            <td><?php

                if ($row['qtyOnHand'] == 0) {
                  echo "<p class='red-text font-weight-bold'>Out of Stock</p>";
                } else {
                  echo $row['qtyOnHand'];
                }


                ?></td>
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