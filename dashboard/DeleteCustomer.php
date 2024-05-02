<?php
require_once("../config/db.php");

    $customerID = $_GET["id"];
    if($customerObj->DeleteCustomerRowData($customerID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="AdminCustomer.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="AdminCustomer.php"
		</script>';
    }

?>