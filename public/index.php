<?php
include("./layouts/header.php");
if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType']  == 1) {
  header("location:home.php");
} else if (isset($_SESSION['accountID']) and isset($_SESSION['accountType']) and $_SESSION['accountType']  >= 2) {
  header("location:admin");
}

if (isset($_POST['s']) && $_POST['s'] == 1) {
  $username = $conn->real_escape_string($_POST['username']);
  $username = htmlentities($username);
  $pwd = $conn->real_escape_string($_POST['password']);
  $pwd = htmlentities($pwd);



  if (!empty($username) && !empty($pwd)) {
    if ($sql = $conn->prepare("SELECT * FROM accounts")) {
      if ($sql->execute()) {
        //see if there's an existing account;
        $result = $sql->get_result();
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            if ($row['username'] == $username && password_verify($pwd, $row['password'])) {
              //make the user log in 

              $_SESSION['accountID'] = $row['id'];
              $_SESSION['accountType'] = $row['accountType'];
              $_SESSION['username'] = $row['username'];
              if ($row['accountType'] > 1) {
                //admin page
                header("location:admin/index.php");
              } else {
                //client_side
                header("location:home.php");
              }


              //redirect
            } else {
              //Wrong Password Credential
              $_SESSION['x'] = warning("Wrong Credentials");
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
        <div class="row ">

          <!--Grid column-->
          <div class="col-md-6 mb-4 white-text text-center text-md-left animated bounceInUp slow">

            <h1 class="display-4 font-weight-bold">INVETOTRACK</h1>

            <hr class="hr-light">

            <h2>
              <strong>We Keep Things Tracked</strong>
            </h2>

            <a href="register.php" class="btn btn-success btn-lg animated pulse infinite">Sign up
              <i class="fas fa-sign-in-alt ml-2"></i>
            </a>

          </div>
          <!--Grid column-->

          <!--Grid column-->
          <div class="col-md-6 col-xl-5 mb-4 ">

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
                    <strong>Log in</strong>
                  </h3>
                  <hr>

                  <div class="md-form">
                    <i class="fas fa-user prefix grey-text"></i>
                    <input type="text" value="<?php echo $_POST['username'] ?? ''; ?>" id="username" class="form-control" name="username">
                    <label for="username">Username</label>
                  </div>
                  <div class="md-form">
                    <i class="fas fa-key prefix grey-text"></i>
                    <input type="password" id="password" class="form-control" name="password">
                    <label for="password">Password </label>
                    <p class="ml-3 p-2">
                      <input type="checkbox" onclick="showPwd()">
                      Show password
                      <a href="recover.php">Forgot Password?</a>
                    </p>

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