<?php
require_once("../config/db.php");
unset($_SESSION['loggedin']);
unset($_SESSION['admin_id']);
$_SESSION['logout'] = "logout";
header("location: index.php");
?>