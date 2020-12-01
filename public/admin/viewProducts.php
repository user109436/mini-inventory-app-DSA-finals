<?php
#TODO search label need to be fixed
#TODO icons

// if ($sql = $conn->prepare("select * from products order by id desc")) {
//   // $sql->execute();
//   // $result = $sql->get_result();
if ($result = openQuery("select * from products order by id desc")) {

?>

  <a href="addProducts.php" class="btn btn-success btn-sm">Add products</a>
  <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
    <thead class="blue white-text">
      <tr>
        <th class="th-sm">Manipulate
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
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

      ?>
          <tr>
            <td><a href="editProducts.php?productID=<?php echo $row['id'] ?>" class="btn btn-info btn-sm">Edit</a><button onclick="del(this.value)" value="<?php echo $row['id'] ?>" class="deleteProduct btn btn-danger btn-sm">Delete</button></td>
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
      } else {
        echo warning();
      }
    }

    ?>
    </tbody>
  </table>

  <script type="text/javascript">
    function del(id) {
      let x = confirm(`Delete ID: ${id}?`);
      console.log(x);
      if (x) {
        window.location = `index.php?productID=${id}`;
      }
    }
  </script>