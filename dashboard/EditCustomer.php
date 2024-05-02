<?php
require_once("layout/header.php");

$customerID = $_GET['id'];

if(isset($_POST["edit"])){
    $customerName = $_POST["CustomerUsername"];
    $customerPassword = $_POST["CustomerPassword"];
    $emailAddress = $_POST["EmailAddress"];
    $firstName = $_POST["FirstName"];
    $middleName = $_POST["MiddleName"];
    $lastName = $_POST["LastName"];
    $birthDate = date("Y-m-d", strtotime($_POST["Birthdate"]));
    $contactNum = $_POST["ContactNum"];
    $accountStatus = $_POST["AccountStatus"];

    if($customerObj->editCustomerRowData($customerID, $customerName, $customerPassword, $emailAddress, $firstName, $middleName, $lastName, $birthDate, $contactNum, $accountStatus)){
		echo 
		'<script language="javascript">
		alert("Edit Successful!")
		window.location.href="AdminCustomer.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Edit Failed!")
		window.location.href="AdminCustomer.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminCustomer.php";';
    echo '</script>';
}

if($_GET['id']){
    $rowData = $customerObj->GetCustomerRowData($customerID);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Customer Data</h4>
        <p class="card-description">
        Customer Existing Information/Data
        </p>
        <form class="forms-sample" method="post">
        <div class="form-group">
            <label for="CustomerUsername">Customer Username</label>
            <input type="text" class="form-control" id="CustomerUsername" name="CustomerUsername" placeholder="Customer Username" value="<?php echo $rowData['CustomerUsername']; ?>">
        </div>
        <div class="form-group">
            <label for="CustomePassword">Customer Password</label>
            <input type="password" class="form-control" id="CustomerPassword" name="CustomerPassword" placeholder="Customer Password" value="<?php echo $rowData['CustomerPassword']; ?>">
        </div>
        <div class="form-group">
            <label for="EmailAddress">Email Address</label>
            <input type="email" class="form-control" id="EmailAddress" name="EmailAddress" placeholder="Email Address" value="<?php echo $rowData['EmailAddress']; ?>">
        </div>
        <div class="form-group">
            <label for="FirstName">First Name</label>
            <input type="text" class="form-control" id="FirstName" name="FirstName" placeholder="First Name" value="<?php echo $rowData['FirstName']; ?>">
        </div>
        <div class="form-group">
            <label for="MiddleName">Middle Name</label>
            <input type="text" class="form-control" id="MiddleName" name="MiddleName" placeholder="Middle Name" value="<?php echo $rowData['MiddleName']; ?>">
        </div>
        <div class="form-group">
            <label for="LastName">Last Name</label>
            <input type="text" class="form-control" id="LastName" name="LastName" placeholder="Last Name" value="<?php echo $rowData['LastName']; ?>">
        </div>
        <div class="form-group">
            <label for="Birthdate">Birth Date</label>
            <input type="date" class="form-control" id="Birthdate" name="Birthdate" placeholder="Birth Date" value="<?php echo $rowData['Birthdate']; ?>">
        </div>
        <div class="form-group">
            <label for="ContactNum">Contact Number</label>
            <input type="text" class="form-control" id="ContactNum" name="ContactNum" placeholder="Contact Number" value="<?php echo $rowData['ContactNum']; ?>">
        </div>
        <div class="form-group">
            <label for="Account Status">Account Status</label>
            <input type="text" class="form-control" id="AccountStatus" name="AccountStatus" placeholder="Account Status" value="<?php echo $rowData['AccountStatus']; ?>">
        </div>
        <button type="submit" class="btn btn-primary mr-2" name="edit">Edit</button>
        <button class="btn btn-light" name="cancel">Cancel</button>
        </form>
    </div>
    </div>
</div>

<?php
    require_once("layout/footer.php");
?>

