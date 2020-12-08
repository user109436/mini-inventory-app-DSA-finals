<?php

include("./layouts/header.php");
pageRestrict();
if (isset($_POST['s']) && $_POST['s'] == 1) {
    $accountInfo = sanitizeInput($_POST['accounts']); //sanitize values
    $accountInfo[4] = (int)$accountInfo[4];

    if (noEmptyField($_POST['accounts'])) {

        if (isset($_SESSION['accountType']) and $_SESSION['accountType'] == 4) { //for system admin only
            $accountInfo[1] = password_hash($accountInfo[1], PASSWORD_DEFAULT);
            if ($sql = isPrep("UPDATE accounts SET username=?, password=?, recoveryKey=?, questionKey=?, accountType=? WHERE id=?")) {
                $sql->bind_param("ssssss", $accountInfo[0], $accountInfo[1], $accountInfo[2], $accountInfo[3], $accountInfo[4], $accountInfo[5]);
            }
        } else {
            if ($sql = isPrep("UPDATE accounts SET username=?, recoveryKey=?, questionKey=?, accountType=? WHERE id=?")) {
                $sql->bind_param("sssss", $accountInfo[0], $accountInfo[1], $accountInfo[2], $accountInfo[3], $accountInfo[4]);
            }
        }

        if (isExecute($sql)) {
            header("location:viewAccounts.php");
            $_SESSION['msg'] = success($accountInfo[0] . " Successfully Updated");
        }
    }
}

if (isset($_GET['accountID']) && validateParamID('accountID')) {
    $id = $_GET['accountID'];

    $result = getById('accounts', $id);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
?>
        <div class="container mt-5">
            <!-- Material form register -->
            <div class="row">
            </div>
            <div class=" card">

                <h5 class="card-header info-color white-text text-center py-4">
                    <strong>Edit Account</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5 pt-0">

                    <!-- Form -->
                    <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                        <div class="form-row">
                            <div class="col-12">
                                <div class="md-form">
                                    <input value="<?php echo $row['username'] ?>" required type="text" id="username" class="form-control" name="accounts[0]">
                                    <label for="username">Username</label>
                                </div>
                            </div>
                            <?php

                            allowSystemAdmin('
                            <div class="col-12">
                                <div class="md-form">
                                    <input value="' . $row['password'] . '" required type="text" id="pwd" class="form-control" name="accounts[1]">
                                    <label for="pwd">Password</label>
                                </div>
                            </div>
                            ');
                            ?>

                            <div class="col-12">
                                <div class="md-form">
                                    <input value="<?php echo $row['recoveryKey'] ?>" required type="text" id="recoverKey" class="form-control" name="accounts[2]">
                                    <label for="recoverKey">Recover Key</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="md-form">
                                    <input value="<?php echo $row['questionKey'] ?>" required type="text" id="questionKey" class="form-control" name="accounts[3]">
                                    <label for="questionKey">Question Key</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="md-form">
                                    <select class=" p-2 col-6" name="accounts[4]" required>
                                        <option value="1" selected>User</option>
                                        <option value="2">Encoder</option>
                                        <option value="3">Senior Staff</option>
                                        <option value="4">System Admin</option>
                                    </select>
                                </div>

                            </div>



                            <input type="hidden" value="<?php echo $id ?>" name="accounts[5]">
                            <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="s" value="1">Submit</button>


                            <hr>

                    </form>

                </div>

            </div>
            <!-- Material form register -->
        </div>

<?php
    } else {
        echo warning();
    }
} else {
    echo warning("Account Not Found Sorry");
}
include("./layouts/footer.php");


?>