<?php
require_once("layout/header.php");
?>

<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Customer Table</h4>
            <p class="card-description">
                Customer table consists of customer's data
            </p>
            <a href="AddCustomer.php"><button type="submit" class="btn btn-primary mt-3" name="Add">Add</button></a>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Customer ID</th>
                            <th>Customer Username</th>
                            <th>Customer Password</th>
                            <th>Email Address</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Birth Date</th>
                            <th>Contact Number</th>
                            <th>Account Status</th>
                            <th>Delete Customer</th>
                            <th>Edit Customer</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $rowArr = $customerObj->getAllCustomerData();
                            if(!is_null($rowArr)){
                                foreach($rowArr as $row){
                                    echo "<tr>";
                                    echo "<td>". $row['CustomerID'] ."</td>";
                                    echo "<td>". $row['CustomerUsername'] ."</td>";
                                    echo "<td>". $row['CustomerPassword'] ."</td>";
                                    echo "<td>". $row['EmailAddress'] ."</td>";
                                    echo "<td>". $row['FirstName'] ."</td>";
                                    echo "<td>". $row['MiddleName'] ."</td>";
                                    echo "<td>". $row['LastName'] ."</td>";
                                    echo "<td>". $row['Birthdate'] ."</td>";
                                    echo "<td>". $row['ContactNum'] ."</td>";
                                    echo "<td>". ($row['AccountStatus'] == 1 ? "Active" : "Deactivated") ."</td>";
                                    echo "<td><a href='DeleteCustomer.php?id=". $row['CustomerID'] ."'><i class='mdi mdi-delete'></i></a></td>";
                                    echo "<td><a href='EditCustomer.php?id=". $row['CustomerID'] ."'><i class='mdi mdi-table-edit'></i></a></td>";
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