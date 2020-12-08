<?php
include("./layouts/header.php");
if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType']  == 1) {
    header("location:home.php");
} else if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType']  >= 2) {
    header("location:admin");
}

if (isset($_POST['s']) && $_POST['s'] == 1) {
    $username = strip_tags($conn->real_escape_string($_POST['username']));
    $recoveryKey = strip_tags($conn->real_escape_string($_POST['recoveryKey']));
    $questionKey = strip_tags($conn->real_escape_string($_POST['questionKey']));
    $pwd = strip_tags($conn->real_escape_string($_POST['password']));
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);


    if (!empty($username) && !empty($pwd) && !empty($recoveryKey) && !empty($questionKey)) {
        if ($sql = $conn->prepare("SELECT * FROM accounts")) {
            if ($sql->execute()) {
                //see if username is taken
                $accountExist = false;
                $result = $sql->get_result();
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        if ($row['username'] == $username) { //if username already exist
                            $_SESSION['x'] = warning("Username already Taken");
                            $accountExist = true;
                            break;
                        }
                    }
                    if (!$accountExist) {
                        //create account
                        $accountType = 1;
                        if ($sql = isPrep("INSERT INTO accounts (username, password, recoveryKey, questionKey, accountType) VALUES(?,?,?,?,?)")) {
                            $sql->bind_param("sssss", $username, $pwd, $recoveryKey, $questionKey, $accountType);
                            if (isExecute($sql)) {
                                $_SESSION['accountID'] = $conn->insert_id;
                                $_SESSION['accountType'] = $accountType;
                                header("location:home.php");
                                exit;
                            }
                        }
                    }
                }
            } else {
                //error
                echo error("There's Something Wrong Processing the Query");
            }
        } else {
            echo error("Error in Query");
        }
    } else {
        echo error("Please Fill Up the Required Fields");
    }
}

?>

<body>
    <!-- Full Page Intro -->
    <div class="view full-page-intro" style="height:100vh; background-image: url( node_modules/mdbootstrap/img/inventory.svg); background-repeat: no-repeat; background-size: cover;">

        <!-- Mask & flexbox options-->
        <div class="mask rgba-black-light d-flex justify-content-center align-items-center">

            <!-- Content -->
            <div class="container">

                <!--Grid row-->
                <div class="row d-flex justify-content-center">

                    <!--Grid column-->
                    <div class="col-md-12 col-xl-5 mb-4 ">
                        <!--Card-->
                        <div class="card">
                            <?php
                            if (isset($_SESSION['x'])) {
                                echo $_SESSION['x'];
                                unset($_SESSION['x']);
                            }
                            ?>

                            <!--Card content-->
                            <div class="card-body">

                                <!-- Form -->
                                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                                    <!-- Heading -->
                                    <h3 class="dark-grey-text text-center">
                                        <strong>Create Account</strong>
                                    </h3>
                                    <hr>

                                    <div class="md-form">
                                        <i class="fas fa-user prefix grey-text"></i>
                                        <input type="text" value="<?php echo $_POST['username'] ?? ''; ?>" id="username" class="form-control" name="username">
                                        <label for="username">Username</label>
                                    </div>

                                    <div class="md-form">
                                        <i class="fas fa-user prefix grey-text"></i>
                                        <input type="text" value="<?php echo $_POST['recoveryKey'] ?? ''; ?>" id="recoveryKey" class="form-control" name="recoveryKey">
                                        <label for="recoveryKey">Recovery Key</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fas fa-user prefix grey-text"></i>
                                        <input type="text" value="<?php echo $_POST['questionKey'] ?? ''; ?>" id="questionKey" class="form-control" name="questionKey">
                                        <label for="questionKey">Question Key (Hobbies, Favorites and etc)</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fas fa-key prefix grey-text"></i>
                                        <input type="password" id="password" class="form-control" name="password">
                                        <label for="password">Password </label>
                                        <p class="ml-3 p-2">
                                            <input type="checkbox" onclick="showPwd()">
                                            Show password
                                        </p>
                                        <a href="index.php">I Already Have an Account</a>
                                    </div>



                                    <div class="text-center">
                                        <button class="btn btn-success" name="s" value="1">Login</button>
                                    </div>

                                </form>
                                <!-- Form -->

                            </div>

                        </div>
                        <!--/.Card-->

                    </div>
                    <!--Grid column-->

                </div>
                <!--Grid row-->

            </div>
            <!-- Content -->

        </div>
        <!-- Mask & flexbox options-->

    </div>
    <!-- Full Page Intro -->
</body>
<script>
    function showPwd() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php

include("./layouts/footer.php");
?>