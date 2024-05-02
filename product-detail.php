<?php
	require_once("layout/header.php");

	if(isset($_POST["submit"])){
		if($productObj->addProductToCart($_GET['productid'], $_POST['numProduct'], $_SESSION['user_id'])){
			echo '<script language="javascript">';
			echo 'alert("Product successfully added to cart!")';
			echo '</script>';
		}
		else{
			echo '<script language="javascript">';
			echo 'alert("Product failed to be added to cart!")';
			echo '</script>';
		}

	}
	$rowArr = $productObj->GetProductFullRowData($_GET['productid']);
?>

	<!-- breadcrumb -->
	<nav aria-label="breadcrumb">
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="index.php?category=<?php echo $rowArr['CategoryID']?>">
		<?php
			echo $rowArr['CategoryName'];
		?></a></li>
		<li class="breadcrumb-item active" aria-current="page">
		<?php
			echo $rowArr['ProductName'];
		?></li>
	</ol>
	</nav>

	<!-- Product Detail -->
	<div class="container bgwhite p-t-35 p-b-80">
		<div class="flex-w flex-sb">

		
		<div class="w-size13 p-t-30 respon5">
				<div class="wrap-slick3 flex-sb flex-w">
					<div class="wrap-slick3-dots"></div>

					<div class="slick3">
						<div class="item-slick3" data-thumb="<?php echo "dashboard/images/Product/".$rowArr['CategoryName']."/".$rowArr['ProductImage'] ?>">
							<div class="wrap-pic-w">
								<img src="<?php echo "dashboard/images/Product/".$rowArr['CategoryName']."/".$rowArr['ProductImage'] ?>" alt="IMG-PRODUCT">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class=" p-t-30 respon5">
				<h4 class="p-b-13">
					<?php
						echo $rowArr['ProductName'];
					?>
				</h4>

				<span class="">
					<?php
						echo "₱" . $rowArr['ProductPrice'];
					?>
				</span>
				<span class="">
					<?php
						echo "Stock: " . $rowArr['ProductStock'];
					?>
				</span>

				<p class="p-t-10">
					<?php
						echo $rowArr['ProductDescription'];
					?>
				</p>

				<!--  -->
				<div class="p-t-33 p-b-60">

					<div class="flex-r-m flex-w p-t-10">
						<div class="w-size16 flex-m flex-w">
							<form method="post" accept-charset="UTF-8" style="display: -webkit-box;">
								<div class="flex-w bo5 of-hidden m-r-22 m-t-10 m-b-10">
										<button class="btn-num-product-down color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 ti-minus" aria-hidden="true"></i>
										</button>
										<input class="size8 m-text18 t-center num-product" type="number" name="numProduct" value="1">

										<button class="btn-num-product-up color1 flex-c-m size7 bg8 eff2">
											<i class="fs-12 ti-plus" aria-hidden="true"></i>
										</button>
								</div>

								<div class="btn-addcart-product-detail size9 trans-0-4 m-t-10 m-b-10">
									<button type="submit" class="btn btn-primary mr-2" name="submit">Add To Cart</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


<?php
	require_once('layout/footer.php');
?>
