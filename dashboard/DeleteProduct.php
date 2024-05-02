<?php
require_once("../config/db.php");

    $productID = $_GET["id"];
    if($productObj->DeleteProductRowData($productID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="AdminProduct.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="AdminProduct.php"
		</script>';
    }

?>