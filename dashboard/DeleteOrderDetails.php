<?php
require_once("../config/db.php");

    $orderDetailsID = $_GET["id"];
    if($orderDetailsObj->DeleteOrderDetailsRowData($orderDetailsID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="AdminOrderDetails.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="AdminOrderDetails.php"
		</script>';
    }

?>