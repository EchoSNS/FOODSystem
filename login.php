<?php
require_once('layout/header.php');

if(isset($_SESSION['loggedinuser'])){
  echo 
		'<script language="javascript">
		window.location.href="index.php"
		</script>';
}else{
  if(isset($_POST["submit"])){
    $username = $_POST["username"]; 
    $password = $_POST["password"]; 
    if($customerObj->accountCheck($username,$password)){ 
      unset($_SESSION['logout']); 
      $_SESSION["user_id"] = $customerObj->getCustomerID($username);
      $_SESSION["loggedinuser"] = "Logged In";
        echo 
      '<script language="javascript">
      window.location.href="index.php"
      </script>';
    }
    else{
        if($customerObj->accountDeactivated){
          $_SESSION["invalid"] = "Account Deactivated";
        }else{
          $_SESSION["invalid"] = "Wrong username or password";
        }
    }
  }
}
?>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="dashboard/images/logo.png" alt="logo" class="mx-auto d-block">
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
<?php
require_once('layout/footer.php');
?>