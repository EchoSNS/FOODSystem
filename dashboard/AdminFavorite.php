<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Favorite Table</h4>
            <p class="card-description">
                Favorite Table consists of favorite product data of customers
            </p>
            <a href="AddFavorite.php"><button type="submit" class="btn btn-primary mt-3" name="Add">Add</button></a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Favorite ID</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Customer ID</th>
                            <th>Customer Username</th>
                            <th>Delete Order</th>
                            <th>Edit Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $favoriteObj->getAllFavoriteFullData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<tr>";
                                    echo "<td>". $row['FavoriteID'] ."</td>";
                                    echo "<td>". $row['ProductID'] ."</td>";
                                    echo "<td>". $row['ProductName'] ."</td>";
                                    echo "<td>". $row['CustomerID'] ."</td>";
                                    echo "<td>". $row['CustomerUsername'] ."</td>";
                                    echo "<td><a href='DeleteFavorite.php?id=". $row['FavoriteID'] ."'><i class='mdi mdi-delete'></i></a></td>";
                                    echo "<td><a href='EditFavorite.php?id=". $row['FavoriteID'] ."'><i class='mdi mdi-table-edit'></i></a></td>";
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