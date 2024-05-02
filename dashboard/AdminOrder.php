<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Table</h4>
            <p class="card-description">
                Order Table consists of order data
            </p>
            
            <a href="AddOrder.php"><button type="submit" class="btn btn-primary mt-3" name="Add">Add</button></a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer ID</th>
                            <th>Customer Name</th>
                            <th>Order Date & Time</th>
                            <th>Order Status</th>
                            <th>Delete Order</th>
                            <th>Edit Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $orderObj->getAllOrderFullData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<tr>";
                                    echo "<td>". $row['OrderID'] ."</td>";
                                    echo "<td>". $row['CustomerID'] ."</td>";
                                    echo "<td>". $row['CustomerUsername'] ."</td>";
                                    echo "<td>". $row['Order_DateTime'] ."</td>";
                                    echo "<td>". ($row['OrderStatus'] == 0 ? "Processed" : "On Cart") ."</td>";
                                    echo "<td><a href='DeleteOrder.php?id=". $row['OrderID'] ."'><i class='mdi mdi-delete'></i></a></td>";
                                    echo "<td><a href='EditOrder.php?id=". $row['OrderID'] ."'><i class='mdi mdi-table-edit'></i></a></td>";
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