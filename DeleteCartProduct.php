<?php
require_once("config/db.php");

    $productID = $_GET["productid"];
    if($productObj->removeProductInCart($_SESSION["user_id"], $productID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="cart.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="cart.php"
		</script>';
    }

?>