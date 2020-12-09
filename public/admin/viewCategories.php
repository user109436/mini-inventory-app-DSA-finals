<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
deleteItem('categories', 'categoryID', 'viewCategories.php');

?>
<div class="table-responsive p-3">
    <div class="container actions">
        <a href="addCategory.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Category</a>
    </div>


    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <?php
                restrict('<th class="th-sm">Manipulate
                </th>');
                ?>


                <th class="th-sm">ID
                </th>
                <th class="th-sm">Name
                </th>
                <th class="th-sm">Number of Products with this Category
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("categories order by id desc")) {
                while ($row = $result->fetch_assoc()) {
                    // unset($sql);

            ?>
                    <tr>
                        <?php
                        restrict('<td><a href="editCategory.php?categoryID=' . $row['id'] . '" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a><button onclick="del(\'viewCategories.php?categoryID=\',this.value)" value="' . $row['id'] . '" class="deleteProduct btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></td>
                        ');
                        ?>
                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <?php if ($categories = openQuery("select * from products  where catID=" . $row['id'])) {
                            echo "<td> $categories->num_rows</td>";
                        }
                        ?>
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