<?php
require_once("layout/header.php");

if(isset($_SESSION['loggedinuser'])){
  echo 
		'<script language="javascript">
		window.location.href="index.php"
		</script>';
}
if(isset($_POST["add"])){
  $customerName = $_POST["CustomerUsername"];
  $customerPassword = $_POST["CustomerPassword"];
  $emailAddress = $_POST["EmailAddress"];
  $firstName = $_POST["FirstName"];
  $middleName = $_POST["MiddleName"];
  $lastName = $_POST["LastName"];
  $birthDate = date("Y-m-d", strtotime($_POST["Birthdate"]));
  $contactNum = $_POST["ContactNum"];

  if($customerObj->createCustomerAccount($customerName, $customerPassword, $emailAddress, $firstName, $middleName, $lastName, $birthDate, $contactNum, 1)){
    $_SESSION['success'] = "Account created successfully";
    echo 
		'<script language="javascript">
		alert("Account created Successfully!")
		window.location.href="login.php"
		</script>';
  }else if($customerObj->usernameExists){
      $_SESSION['fail'] = "Username already exist";
  }else if($customerObj->emailExists){
      $_SESSION['fail'] = "Email already exist";
  }
}
else if (isset($_POST['cancel'])){
      echo '<script language="javascript">';
      echo 'window.location.href="index.php";';
      echo '</script>';
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
              <h4>New here?</h4>
              <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
              <form class="forms-sample" method="post">
                <div class="form-group">
                    <label for="CustomerUsername">Customer Username</label>
                    <input type="text" class="form-control" id="CustomerUsername" name="CustomerUsername" placeholder="Customer Username">
                </div>
                <div class="form-group">
                    <label for="CustomerName">Customer Password</label>
                    <input type="password" class="form-control" id="CustomerPassword" name="CustomerPassword" placeholder="Customer Password">
                </div>
                <div class="form-group">
                    <label for="EmailAddress">Email Address</label>
                    <input type="email" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <label for="FirstName">First Name</label>
                    <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name">
                </div>
                <div class="form-group">
                    <label for="MiddleName">Middle Name</label>
                    <input type="text" class="form-control" id="MiddleName" name="MiddleName" placeholder="Middle Name">
                </div>
                <div class="form-group">
                    <label for="LastName">Last Name</label>
                    <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <label for="Birthdate">Birth Date</label>
                    <input type="date" class="form-control" id="Birthdate" name="Birthdate" placeholder="Birth Date">
                </div>
                <div class="form-group">
                    <label for="ContactNum">Contact Number</label>
                    <input type="text" class="form-control" id="ContactNum" name="ContactNum" placeholder="Contact Number">
                </div>
                
              <?php
                if(isset($_SESSION['success']))
                {
                      echo "<h4 class='my-1 text-danger my-4'> " .$_SESSION['success']. "</h4>";
                      unset($_SESSION['success']);
                    }
                    if(isset($_SESSION['fail'])){
                      echo "<h4 class='my-1 text-danger my-4'> " .$_SESSION['fail']. "</h4>";
                      unset($_SESSION['fail']);
                    }
              ?>
                <button type="submit" class="btn btn-primary mr-2" name="add">Create</button>
                <button class="btn btn-light" name="cancel">Cancel</button>
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
require_once("layout/footer.php");
?>