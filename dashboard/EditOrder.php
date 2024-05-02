<?php
require_once("layout/header.php");

$orderID = $_GET['id'];

if(isset($_POST["edit"])){
    $customerID = $_POST["CustomerID"];
    $orderDateTime = date("Y-m-d H:i:s",strtotime($_POST["Order_DateTime"]));
    $orderStatus = $_POST["OrderStatus"];

    if($orderObj->editOrderRowData($orderID, $customerID, $orderDateTime, $orderStatus)){
		echo 
		'<script language="javascript">
		alert("Edit Successful!")
		window.location.href="AdminOrder.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Edit Failed!")
		window.location.href="AdminOrder.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminOrder.php";';
    echo '</script>';
}

if($_GET['id']){
    $rowData = $orderObj->GetOrderRowData($orderID);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Order Data</h4>
        <p class="card-description">
        Order Existing Information/Data
        </p>
        <form class="forms-sample" method="post">
            <div class="form-group">
                <label for="CustomerID">Customer ID</label>
                <select class="form-control" id="exampleFormControlSelect1" id="CustomerID" name="CustomerID">
                    <?php
                        $rowArr = $customerObj->getAllCustomerData();
                        if(!is_null($rowArr)){
                            foreach($rowArr as $row){
                                echo "<option value='" .$row['CustomerID']. "' ". ($row['CustomerID'] == $rowData['CustomerID'] ? "selected" : "") .">".$row['CustomerUsername']."</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Order_DateTime">Order Date & Time</label>
                <input type="datetime-local" class="form-control" id="Order_DateTime" name="Order_DateTime" value="<?php echo date('Y-m-d\TH:i', strtotime($rowData['Order_DateTime'])); ?>">
            </div>
            <div class="form-group">
                <label for="OrderStatus">Order Status</label>
                <input type="number" class="form-control" id="OrderStatus" name="OrderStatus" placeholder="OrderStatus" value="<?php echo $rowData['OrderStatus']; ?>">
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

