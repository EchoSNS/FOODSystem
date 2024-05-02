<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Category Table</h4>
            <p class="card-description">
                Category table consists of product data
            </p>
            
            <a href="AddCategory.php"><button type="submit" class="btn btn-primary mt-3" name="Add">Add</button></a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Delete Category</th>
                            <th>Edit Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $categoryObj->getAllCategoryData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<tr>";
                                    echo "<td>". $row['CategoryID'] ."</td>";
                                    echo "<td>". $row['CategoryName'] ."</td>";
                                    echo "<td><a href='DeleteCategory.php?id=". $row['CategoryID'] ."'><i class='mdi mdi-delete'></i></a></td>";
                                    echo "<td><a href='EditCategory.php?id=". $row['CategoryID'] ."'><i class='mdi mdi-table-edit'></i></a></td>";
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
require_once("layout/footer.php");
?>