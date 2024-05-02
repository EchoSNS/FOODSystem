<?php
require_once("layout/header.php");

if(isset($_POST["add"])){
    $categoryName = $_POST["CategoryName"];

    if($categoryObj->addCategoryRowData($categoryName)){
		echo 
		'<script language="javascript">
		alert("Add Successful!")
		window.location.href="AdminCategory.php"
		</script>';
    }
    else{
		echo '<script language="javascript">';
		echo 'alert("Add Failed!")
		window.location.href="AdminCategory.php"';
		echo '</script>';
    }
}
else if (isset($_POST['cancel'])){
    echo '<script language="javascript">';
	echo 'window.location.href="AdminCategory.php";';
    echo '</script>';
}
?>
<div class="col-12 grid-margin stretch-card">
    <div class="card">
    <div class="card-body">
        <h4 class="card-title">Add Category Data</h4>
        <p class="card-description">
        Adding Category Information/Data
        </p>
        <form class="forms-sample" method="post">
        <div class="form-group">
            <label for="CategoryName">Category Name</label>
            <input type="text" class="form-control" id="CategoryName" name="CategoryName" placeholder="Category Name">
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

