<?php
ob_start();
include("./layouts/header.php");

#TODO responsive category and supplier id overlaps in responsive view

if (isset($_POST['s']) && $_POST['s'] == 1) {
    $accountInfo = sanitizeInput($_POST['accounts']); //sanitize values
    if (noEmptyField($_POST['accounts'])) {
        $accountInfo[1] = password_hash($accountInfo[1], PASSWORD_DEFAULT);
        if ($sql = isPrep("INSERT INTO accounts  (username, password, recoveryKey, questionKey, accountType) VALUES(?,?,?,?,?)")) {
            $sql->bind_param("sssss", $accountInfo[0], $accountInfo[1], $accountInfo[2], $accountInfo[3], $accountInfo[4]);
            if (isExecute($sql)) {
                header("location:viewAccounts.php"); //headers already sent
                $_SESSION['msg'] = success($accountInfo[0] . " Successfully Created");
            }
        }
    }
}

?>

<div class="container mt-5">
    <!-- Material form register -->
    <div class="row">
    </div>
    <div class=" card">

        <h5 class="card-header info-color white-text text-center py-4">
            <strong>Add Account</strong>
        </h5>

        <!--Card content-->
        <div class="card-body px-lg-5 pt-0">

            <!-- Form -->
            <form class="text-center warning" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                <div class="form-row">
                    <div class="col-12">
                        <div class="md-form">
                            <input value="<?php echo $_GET['accounts'][0] ?? '' ?>" required type="text" id="username" class="form-control" name="accounts[0]">
                            <label for="username">Username</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="md-form">
                            <input value="<?php echo $_GET['accounts'][1] ?? '' ?>" required type="text" id="pwd" class="form-control" name="accounts[1]">
                            <label for="pwd">Password</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="md-form">
                            <input value="<?php echo $_GET['accounts'][2] ?? '' ?>" required type="text" id="recoverKey" class="form-control" name="accounts[2]">
                            <label for="recoverKey">Recover Key</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="md-form">
                            <input value="<?php echo $_GET['accounts'][3] ?? '' ?>" required type="text" id="questionKey" class="form-control" name="accounts[3]">
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
                    <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit" name="s" value="1">Submit</button>
                    <hr>

            </form>

        </div>

    </div>
    <!-- Material form register -->
</div>

<?php

include("./layouts/footer.php");
ob_end_flush();

?>