<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Product Table</h4>
            <p class="card-description">
                Product table consists of product's data including category
            </p>
            
            <a href="AddProduct.php"><button type="submit" class="btn btn-primary mt-3" name="Add">Add</button></a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Product ID</th>
                            <th>Category ID</th>
                            <th>Category Name</th>
                            <th>Product Name</th>
                            <th>Product Description</th>
                            <th>Product Price</th>
                            <th>Product Stock</th>
                            <th>Product Image</th>
                            <th>Delete Product</th>
                            <th>Edit Product</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $productObj->getAllProductFullData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<tr>";
                                    echo "<td>". $row['ProductID'] ."</td>";
                                    echo "<td>". $row['CategoryID'] ."</td>";
                                    echo "<td>". $row['CategoryName'] ."</td>";
                                    echo "<td>". $row['ProductName'] ."</td>";
                                    echo "<td>". $row['ProductDescription'] ."</td>";
                                    echo "<td>₱". $row['ProductPrice'] ."</td>";
                                    echo "<td>". $row['ProductStock'] ."</td>";
                                    echo "<td>". $row['ProductImage'] ."</td>";
                                    echo "<td><a href='DeleteProduct.php?id=". $row['ProductID'] ."'><i class='mdi mdi-delete'></i></a></td>";
                                    echo "<td><a href='EditProduct.php?id=". $row['ProductID'] ."'><i class='mdi mdi-table-edit'></i></a></td>";
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