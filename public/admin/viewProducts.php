<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");

if (validateParamID('productID')) {
  if ($sql = getById('products', $_GET['productID'])) {
    logProduct($sql->fetach_all()[0], $_SESSION['accountID'], 3);
  }
}
// deleteItem('products', 'productID', 'viewProducts.php');
?>
<div class="table-responsive p-3">

  <a href="addProduct.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Product </a>
  <a href="addStock.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Stock</a>

  <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
    <thead class="blue white-text">
      <tr>
        <th class="th-sm">Edit
        </th>
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
            <td><a href="editProduct.php?productID=<?php echo $row['id'] ?>" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a><button onclick="del('viewProducts.php?productID=',this.value)" value="<?php echo $row['id'] ?>" class="deleteProduct btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></td>
            <td><?php echo $row['id'] ?></td>
            <td><?php echo $row['name'] ?></td>
            <td><?php echo $row['catID'] ?></td>
            <td><?php echo $row['supID'] ?></td>
            <td><?php echo $row['forsale'] ?></td>
            <td><?php echo $row['qtyOnHand'] ?></td>
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