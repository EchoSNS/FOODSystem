<?php
require_once("layout/header.php");

if(isset($_POST["add"])){
    $orderID = $_POST["OrderID"];
    $productID = $_POST["ProductID"];
    $orderQuantity = $_POST["OrderQuantity"];

    if($orderDetailsObj->addOrderDetails($orderID, $productID, $orderQuantity)){
		echo 
		'<script language="javascript">
		alert("Add Successful!")
		window.location.href="AdminOrderDetails.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Add Failed!")
		window.location.href="AdminOrderDetails.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminOrderDetails.php";';
    echo '</script>';
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Order Details Data</h4>
            <p class="card-description">
            Adding Order Details Information/Data
            </p>
            <form class="forms-sample" method="post">
                <div class="form-group">
                    <label for="OrderID">Order ID</label>
                    <select class="form-control" id="exampleFormControlSelect1" id="OrderID" name="OrderID">
                        <?php
                            $rowArr = $orderObj->getAllOrderFullData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<option value='" .$row['OrderID']. "'>".$row['OrderID']." (". $row['CustomerUsername'] .")</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="ProductID">Product ID</label>
                    <select class="form-control" id="exampleFormControlSelect1" id="ProductID" name="ProductID">
                        <?php
                            $rowArr = $productObj->getAllProductData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<option value='" .$row['ProductID']. "'>".$row['ProductName']."</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="OrderQuantity">Order Quantity</label>
                    <input type="number" class="form-control" id="OrderQuantity" name="OrderQuantity" placeholder="OrderQuantity">
                </div>
                <button type="submit" class="btn btn-primary mr-2" name="add">Add</button>
                <button class="btn btn-light" name="cancel">Cancel</button>
            </form>
        </div>
    </div>
</div>

<?php
    require_once("layout/footer.php");
?>

