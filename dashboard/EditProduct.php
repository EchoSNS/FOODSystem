<?php
require_once("layout/header.php");

$productID = $_GET['id'];

if(isset($_POST["edit"])){
    $categoryID = $_POST["CategoryID"];
    $productName = $_POST["ProductName"];
    $productDescription = $_POST["ProductDescription"];
    $productPrice = $_POST["ProductPrice"];
    $productStock = $_POST["ProductStock"];
    $productImage =$_POST["ProductImage"];

    if($productObj->editProductRowData($productID, $categoryID, $productName, $productDescription, $productPrice, $productStock, $productImage)){
		echo 
		'<script language="javascript">
		alert("Edit Successful!")
		window.location.href="AdminProduct.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Edit Failed!")
		window.location.href="AdminProduct.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminProduct.php";';
    echo '</script>';
}

if($_GET['id']){
    $rowData = $productObj->GetProductRowData($productID);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Product Data</h4>
        <p class="card-description">
        Product Existing Information/Data
        </p>
        <form class="forms-sample" method="post">
            <div class="form-group">
                <label for="ProductName">Product Name</label>
                <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name" value="<?php echo $rowData['ProductName'];?>">
            </div>
            <div class="form-group">
            <label for="CategoryName">Category Name</label>
            <select class="form-control" id="exampleFormControlSelect1" id="CategoryID" name="CategoryID">
                <?php
                    $rowArr = $categoryObj->getAllCategoryData();
                    if(!is_null($rowArr)){
                        foreach($rowArr as $row){
                            echo "<option value='" .$row['CategoryID']. "' ". ($row['CategoryID'] == $rowData['CategoryID'] ? "selected" : "") .">".$row['CategoryName']."</option>";
                        }
                    }
                ?>
            </select>
            </div>
            <div class="form-group">
                <label for="ProductDescription">Product Description</label>
                <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" placeholder="Product Description" value="<?php echo $rowData['ProductDescription'];?>">
            </div>
            <div class="form-group">
                <label for="ProductPrice">Product Price</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-primary text-white">₱</span>
                    </div>
                    <input type="text" class="form-control" id="ProductPrice" name="ProductPrice" placeholder="Product Price" aria-label="Product Price" value="<?php echo $rowData['ProductPrice'];?>">
                </div>
            </div>
            <div class="form-group">
                <label for="ProductStock">Product Stock</label>
                <input type="text" class="form-control" id="ProductStock" name="ProductStock" placeholder="Product Stock" value="<?php echo $rowData['ProductStock'];?>">
            </div>
            <div class="form-group">
                <label for="ProductImage">Product Image Name</label>
                <input type="text" class="form-control" id="ProductImage" name="ProductImage" placeholder="Product Image Name" value="<?php echo $rowData['ProductImage'];?>">
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

