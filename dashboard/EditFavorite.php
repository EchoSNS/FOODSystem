<?php
require_once("layout/header.php");

$favoriteID = $_GET['id'];

if(isset($_POST["edit"])){
    $productID = $_POST["ProductID"];
    $customerID = $_POST["CustomerID"];

    if($favoriteObj->editFavoriteRowData($favoriteID, $productID, $customerID)){
		echo 
		'<script language="javascript">
		alert("Edit Successful!")
		window.location.href="AdminFavorite.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Edit Failed!")
		window.location.href="AdminFavorite.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminFavorite.php";';
    echo '</script>';
}

if($_GET['id']){
    $rowData = $favoriteObj->GetFavoriteRowData($favoriteID);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Favorite Data</h4>
        <p class="card-description">
        Favorite Existing Information/Data
        </p>
        <form class="forms-sample" method="post">
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
            <button type="submit" class="btn btn-primary mr-2" name="edit">Edit</button>
            <button class="btn btn-light" name="cancel">Cancel</button>
        </form>
    </div>
    </div>
</div>

<?php
    require_once("layout/footer.php");
?>

