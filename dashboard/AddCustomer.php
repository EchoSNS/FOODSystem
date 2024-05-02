<?php
require_once("layout/header.php");

if(isset($_POST["add"])){
    $customerName = $_POST["CustomerUsername"];
    $customerPassword = $_POST["CustomerPassword"];
    $emailAddress = $_POST["EmailAddress"];
    $firstName = $_POST["FirstName"];
    $middleName = $_POST["MiddleName"];
    $lastName = $_POST["LastName"];
    $birthDate = date("Y-m-d", strtotime($_POST["Birthdate"]));
    $contactNum = $_POST["ContactNum"];
    $accountStatus = $_POST["AccountStatus"];

    if($customerObj->createCustomerAccount($customerName, $customerPassword, $emailAddress, $firstName, $middleName, $lastName, $birthDate, $contactNum, $accountStatus)){
		echo 
		'<script language="javascript">
		alert("Add Successful!")
		window.location.href="AdminCustomer.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Add Failed!")
		window.location.href="AdminCustomer.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminCustomer.php";';
    echo '</script>';
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add Customer Data</h4>
        <p class="card-description">
        Adding Customer Information/Data
        </p>
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
        <div class="form-group">
            <label for="Account Status">Account Status</label>
            <input type="text" class="form-control" id="AccountStatus" name="AccountStatus" placeholder="Account Status">
        </div>
        <button type="submit" class="btn btn-primary mr-2" name="add">Add</button>
        <button class="btn btn-light" name="cancel">Cancel</button>
        </form>
    </div>
    </div>
</div>

<?php
    require_once("layout/footer.php");
?>

