<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Order Details Table</h4>
            <p class="card-description">
                Order Details Table consists of order details data
            </p>
            
            <a href="AddOrderDetails.php"><button type="submit" class="btn btn-primary mt-3" name="Add">Add</button></a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order Details ID</th>
                            <th>Order ID</th>
                            <th>Order Status</th>
                            <th>Customer ID</th>
                            <th>Customer Username</th>
                            <th>Product ID</th>
                            <th>Product Name</th>
                            <th>Order Quantity</th>
                            <th>Order Date & Time</th>
                            <th>Delete Order</th>
                            <th>Edit Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $orderDetailsObj->getAllOrderDetailsFullData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<tr>";
                                    echo "<td>". $row['OrderDetailsID'] ."</td>";
                                    echo "<td>". $row['OrderID'] ."</td>";
                                    echo "<td>". ($row['OrderStatus'] == 0 ? "Processed" : "On Cart") ."</td>";
                                    echo "<td>". $row['CustomerID'] ."</td>";
                                    echo "<td>". $row['CustomerUsername'] ."</td>";
                                    echo "<td>". $row['ProductID'] ."</td>";
                                    echo "<td>". $row['ProductName'] ."</td>";
                                    echo "<td>". $row['OrderQuantity'] ."</td>";
                                    echo "<td>". $row['Order_DateTime'] ."</td>";
                                    echo "<td><a href='DeleteOrderDetails.php?id=". $row['OrderDetailsID'] ."'><i class='mdi mdi-delete'></i></a></td>";
                                    echo "<td><a href='EditOrderDetails.php?id=". $row['OrderDetailsID'] ."'><i class='mdi mdi-table-edit'></i></a></td>";
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