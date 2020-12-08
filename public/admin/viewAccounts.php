<?php
#TODO search label need to be fixed
#TODO icons
include("./layouts/header.php");
deleteItem('accounts', 'accountID', 'viewAccounts.php')
?>
<div class="table-responsive p-3">
    <a href="addAccount.php" class="btn btn-success btn-sm"><i class="fas fa-plus-circle fa-lg"></i> Account </a>
    <table id="dtMaterialDesignExample" class="table tabble-striped" cellspacing="0" width="100%">
        <thead class="blue white-text">
            <tr>
                <?php
                restrict(' <th class="th-sm">Edit
                </th>');
                ?>

                <th class="th-sm">ID
                </th>
                <th class="th-sm">Username
                </th>
                <th class="th-sm">Password
                </th>
                <th class="th-sm">Recovery Key
                </th>
                <th class="th-sm">Question Key
                </th>
                <th class="th-sm">Account Type
                </th>
                <th class="th-sm">Date Created
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result = getAllFetch("accounts order by id desc")) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <tr>
                        <?php
                        restrict('
                         <td>
                            <a href="editAccount.php?accountID=' . $row['id'] .
                            '" class="btn btn-info btn-sm"><i class="fas fa-edit"></i>

                            </a>
                            <button onclick="del(\'viewAccounts.php?accountID=\',this.value)" value="' . $row['id'] . '" class=" btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                        </td>
                        ');
                        ?>

                        <td><?php echo $row['id'] ?></td>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo  get_starred($row['password'])
                            ?></td>
                        <td><?php echo $row['recoveryKey'] ?></td>
                        <td><?php echo $row['questionKey'] ?></td>
                        <td><?php
                            echo accountType($row['accountType']);
                            ?></td>

                        <td><?php echo $row['date'] ?></td>
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