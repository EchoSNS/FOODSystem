<?php
session_start();

require_once('controller/CustomerClass.php');
require_once('controller/CategoryClass.php');
require_once('controller/ProductClass.php');
require_once('controller/OrderClass.php');
require_once('controller/OrderDetailsClass.php');
require_once('controller/FavoriteClass.php');
require_once('controller/AdminClass.php');

$db_host="localhost";
$db_user="root";
$db_pass="";
$db_name="foodssystemdb";

try{
    $conn = new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOEXception $e){
    echo "Connection failed: " . $e->getMessage();
}

$customerObj = new CustomerClass($conn);
$categoryObj = new CategoryClass($conn);
$productObj = new ProductClass($conn);
$orderObj = new OrderClass($conn);
$adminObj = new AdminClass($conn);
$favoriteObj = new FavoriteClass($conn);
$orderDetailsObj = new OrderDetailsClass($conn);

?>