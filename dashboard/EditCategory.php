<?php
require_once("layout/header.php");

$categoryID = $_GET['id'];

if(isset($_POST["edit"])){
    $categoryName = $_POST["CategoryName"];

    if($categoryObj->EditCategoryRowData($categoryID, $categoryName)){
		echo 
		'<script language="javascript">
		alert("Edit Successful!")
		window.location.href="AdminCategory.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Edit Failed!")
		window.location.href="AdminCategory.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminCategory.php";';
    echo '</script>';
}

if($_GET['id']){
    $rowData = $categoryObj->GetCategoryRowData($categoryID);
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Edit Category Data</h4>
        <p class="card-description">
        Category Existing Information/Data
        </p>
        <form class="forms-sample" method="post">
        <div class="form-group">
            <label for="CategoryName">Category Name</label>
            <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="Category Name" value="<?php echo $rowData['CategoryName']; ?>">
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

