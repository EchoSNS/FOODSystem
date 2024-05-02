<?php
require_once('../config/db.php');

if(isset($_SESSION['loggedin'])){
  header("location: index.php");
}else{
  if(isset($_POST["submit"])){
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 
    if($adminObj->accountCheck($username,$password)){ 
      unset($_SESSION['logout']); 
      $_SESSION["admin_id"] = $adminObj->getAdminID($username);
      $_SESSION["loggedin"] = "Logged In";
      header("location: index.php");
    }
    else{
        $_SESSION["invalid"] = "Wrong username or password";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>F.O.O.D.S Admin Dashboard Login</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="images/logo.png" alt="logo" class="mx-auto d-block">
              </div>
              <div class="text-center">
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
              </div>
              <form class="pt-3" method="post">
                <label for="Username">Username</label>
                <div class="form-group">
                  <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Username">
                </div>
                <label for="Password">Password</label>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                </div>
              <?php
                  if(isset($_SESSION['invalid']))
                  {
                      echo "<h4 class='my-1 text-danger'> " .$_SESSION['invalid']. "</h4>";
                      unset($_SESSION['invalid']);
                  }
              ?>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>
<div>
</html>
