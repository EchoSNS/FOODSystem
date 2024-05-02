<?php
require_once("layout/header.php");

$orderDetailsID = $_GET['id'];

if(isset($_POST["edit"])){
    $orderID = $_POST["OrderID"];
    $productID = $_POST["ProductID"];
    $orderQuantity = $_POST["OrderQuantity"];

    if($orderDetailsObj->editOrderDetailsRowData($orderDetailsID, $orderID, $productID, $orderQuantity)){
		echo 
		'<script language="javascript">
		alert("Edit Successful!")
		window.location.href="AdminOrderDetails.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Edit Failed!")
		window.location.href="AdminOrderDetails.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminOrderDetails.php";';
    echo '</script>';
}

if($_GET['id']){
    $rowData = $orderDetailsObj->GetOrderDetailsRowData($orderDetailsID);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Order Details Data</h4>
        <p class="card-description">
        Order Details Existing Information/Data
        </p>
        <form class="forms-sample" method="post">
            <div class="form-group">
                <label for="OrderID">Order ID</label>
                <select class="form-control" id="exampleFormControlSelect1" id="OrderID" name="OrderID">
                    <?php
                        $rowArr = $orderObj->getAllOrderFullData();
                        if(!is_null($rowArr)){
                            foreach($rowArr as $row){
                                echo "<option value='" .$row['OrderID']. "' ". ($row['OrderID'] == $rowData['OrderID'] ? "selected" : "") .">".$row['OrderID']." (". $row['CustomerUsername'] .")</option>";
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
                                echo "<option value='" .$row['ProductID']. "' ". ($row['ProductID'] == $rowData['ProductID'] ? "selected" : "") .">".$row['ProductName']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="OrderQuantity">Order Quantity</label>
                <input type="number" class="form-control" id="OrderQuantity" name="OrderQuantity" placeholder="OrderQuantity" value="<?php echo $rowData['OrderQuantity']; ?>">
            </div>
            <button type="submit" class="btn btn-primary mr-2" name="edit">Edit</button>
            <button class="btn btn-light" name="cancel">Cancel</button>
        </form>
    </div>
    </div>
</div>

<?php
    require_once("layout/footer.php");
?>

