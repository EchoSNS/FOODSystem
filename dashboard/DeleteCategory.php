<?php
require_once("../config/db.php");

    $categoryID = $_GET["id"];
    if($categoryObj->DeleteCategoryRowData($categoryID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="AdminCategory.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="AdminCategory.php"
		</script>';
    }

?>