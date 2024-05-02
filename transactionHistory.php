<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Transaction History</h4>
            <p class="card-description">
                Transaction History of <?php echo $customerObj->getCustomerRowData($_SESSION['user_id'])['CustomerUsername'];?>
            </p>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Product Name</th>
                            <th>Order Quantity</th>
                            <th>Order Date & Time</th>
                            <th>Order Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $orderObj->getCustomerOrderFullRowData($_SESSION['user_id']);
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    if($row['OrderStatus'] == 0){
                                        echo "<tr>";
                                        echo "<td><a href='receipt.php?orderid=".$row['OrderID']."'>". $row['OrderID'] ."</a></td>";
                                        echo "<td>". $row['ProductName'] ."</td>";
                                        echo "<td>". $row['OrderQuantity'] ."</td>";
                                        echo "<td>". $row['Order_DateTime'] ."</td>";
                                        echo "<td>". ($row['OrderStatus'] == 0 ? "Processed" : "On Cart") ."</td>";
                                        echo "</tr>";
                                    }
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