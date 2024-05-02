<?php
require_once("config/db.php");
unset($_SESSION['loggedinuser']);
unset($_SESSION['user_id']);
$_SESSION['logout'] = "logout";
header("location: login.php");
?>