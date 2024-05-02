<?php
require_once("../config/db.php");

    $favoriteID = $_GET["id"];
    if($favoriteObj->DeleteFavoriteRowData($favoriteID)){
        echo 
		'<script language="javascript">
		alert("Delete Successful!")
		window.location.href="AdminFavorite.php"
		</script>';
    }
    else{
        echo 
		'<script language="javascript">
		alert("Delete Failed!")
		window.location.href="AdminFavorite.php"
		</script>';
    }

?>