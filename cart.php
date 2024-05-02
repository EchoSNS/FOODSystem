<?php
	require_once("layout/header.php");
	$totalCartPrice = 0;
	
	if(isset($_POST["edit"])){
		$rowArr = $orderObj->listProductInCart($_SESSION['user_id']);
		if(!is_null($rowArr)){
			$counter = 1;
			$stop = count($rowArr);
			foreach($rowArr as $row){
				$stringPost = "OrderQuantity".$row['ProductID'];
				//updating done, continuing to receipt (function returns 1)
				$returnValue = $productObj->checkOut($_SESSION["user_id"], $row['ProductID'], $_POST["OrderQuantity".$row['ProductID']], $counter, $stop);
				if($returnValue == 99){
					echo '<script language="javascript">';
					echo 'alert("Please screenshot your receipt!");';
					echo 'window.location.href="receipt.php?orderid='.$orderObj->getLastOrderData($_SESSION['user_id'])['OrderID'].'"';
					echo '</script>';
				}
				//updating quantity (function returns 2)
				else if($returnValue == 2){
					echo '<script language="javascript">';
					echo 'alert("Updating Product: '.$row["ProductName"].' Quantity!")';
					echo '</script>';
				}
				else if($returnValue == 98){
                    echo
                    '<script language="javascript">
                    alert("Product stock is not enough!")
                    </script>';
				}
				$counter++;
			}
		}
	}
?>

	<!-- Cart -->
	<section class="">
		<div class="container">
			<!-- Cart item -->
			
			<form class="forms-sample" method="post">
				<div class="container-table-cart pos-relative">
					<div class="wrap-table-shopping-cart bgwhite">
						<table class="table-responsive">
							<tr class="table table-hover">
								<th>Customer Name</th>
								<th>Product Name</th>
								<th>Price</th>
								<th>Date and Time</th>
								<th>Quantity</th>
								<th>Total</th>
								<th>Delete</th>
							</tr>
							<?php
								$rowArr = $orderObj->listProductInCart($_SESSION['user_id']);
								if(!is_null($rowArr)){
									foreach($rowArr as $row){
										echo "<tr>";
										echo "<td>". $row['CustomerUsername'] ."</td>";
										echo "<td>". $row['ProductName'] ."</td>";
										echo "<td>₱". $row['ProductPrice'] ."</td>";
										echo "<td>". $row['Order_DateTime'] ."</td>";
										echo "<td>
											<input type='number' class='form-control' id='OrderQuantity".($row['ProductID'])."' name='OrderQuantity".($row['ProductID'])."' value='".$row['OrderQuantity']."'>
										</td>";
										echo "<td>". ((int)$row['OrderQuantity'] * (int)$row['ProductPrice']) ."</td>";
										echo "<td><a href='DeleteCartProduct.php?productid=". $row['ProductID'] ."&customerID=".$row['CustomerID']."'><i class='mdi mdi-delete'></i></a></td>";
										echo "</tr>";
										$totalCartPrice += (int)$row['OrderQuantity'] * (int)$row['ProductPrice'];
									}
								}
							?>
						</table>
					</div>
				</div>
				<button type="submit" class="btn btn-primary mr-2" name="edit">Proceed to Checkout</button>
			</form>

			<!-- Total -->
			<div class="bo9 w-size18 p-l-40 p-r-40 p-t-30 p-b-38 m-t-30 m-r-0 m-l-auto p-lr-15-sm">
				<h3 class="p-b-24">
					Cart Total
				</h5>

				<!--  -->
				<div class="flex-w flex-sb-m p-t-26 p-b-30">
					<span class="w-size19 w-full-sm">
						Total:
					</span>

					<span class="w-size20 w-full-sm">
						₱<?php echo $totalCartPrice; ?>
					</span>
				</div>
			</div>
		</div>
	</section>

<?php
require_once('layout/footer.php');
?>
