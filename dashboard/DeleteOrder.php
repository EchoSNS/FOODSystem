<?php
require_once("../config/db.php");

    $orderID = $_GET["id"];
    if($orderObj->DeleteOrderRowData($orderID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="AdminOrder.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="AdminOrder.php"
		</script>';
    }

?>