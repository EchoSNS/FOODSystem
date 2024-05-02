<?php
require_once("layout/header.php");

if(isset($_POST["add"])){
    $productName = $_POST["ProductName"];
    $categoryID = $_POST["CategoryID"];
    $productDescription = $_POST["ProductDescription"];
    $productPrice = $_POST["ProductPrice"];
    $productStock = $_POST["ProductStock"];
    $productImage =$_POST["ProductImage"];

    if($productObj->addProduct($categoryID, $productName, $productDescription, $productPrice, $productStock, $productImage)){
		echo 
		'<script language="javascript">
		alert("Add Successful!")
		window.location.href="AdminProduct.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Add Failed!")
		window.location.href="AdminProduct.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminProduct.php";';
    echo '</script>';
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Add Product Data</h4>
            <p class="card-description">
            Adding Product Information/Data
            </p>
            <form class="forms-sample" method="post">
                <div class="form-group">
                    <label for="ProductName">Product Name</label>
                    <input type="text" class="form-control" id="ProductName" name="ProductName" placeholder="Product Name">
                </div>
                <div class="form-group">
                <label for="CategoryName">Category Name</label>
                <select class="form-control" id="exampleFormControlSelect1" id="CategoryID" name="CategoryID">
                    <?php
                        $rowArr = $categoryObj->getAllCategoryData();
                        if(!is_null($rowArr)){
                            foreach($rowArr as $row){
                                echo "<option value='" .$row['CategoryID']. "'>".$row['CategoryName']."</option>";
                            }
                        }
                    ?>
                </select>
                </div>
                <div class="form-group">
                    <label for="ProductDescription">Product Description</label>
                    <input type="text" class="form-control" id="ProductDescription" name="ProductDescription" placeholder="Product Description">
                </div>
                <div class="form-group">
                    <label for="ProductPrice">Product Price</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary text-white">₱</span>
                        </div>
                        <input type="text" class="form-control" id="ProductPrice" name="ProductPrice" placeholder="Product Price" aria-label="Product Price">
                    </div>
                </div>
                <div class="form-group">
                    <label for="ProductStock">Product Stock</label>
                    <input type="text" class="form-control" id="ProductStock" name="ProductStock" placeholder="Product Stock">
                </div>
                <div class="form-group">
                    <label for="ProductImage">Product Image Name</label>
                    <input type="text" class="form-control" id="ProductImage" name="ProductImage" placeholder="Product Image Name">
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

